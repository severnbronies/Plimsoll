<?php

/* 
Template Name: Campaign - Stream Team
*/

$context = Timber::context();

$timber_post = new Timber\Post();
$context['post'] = $timber_post;

$users_array = array_map(
	'trim',
	explode(PHP_EOL, get_field('stream_team_members'))
);
$context['stream_calendar_url'] = get_field('stream_calendar_url');
sort($users_array, SORT_NATURAL);
$client_id = get_field('api_twitch_client_id', 'option');
$client_secret = get_field('api_twitch_client_secret', 'option');
$access_token = get_field('api_twitch_access_token', 'option');

function getAccessToken($client_id, $client_secret)
{
	// Get Oauth access token
	$access = curl_init();
	curl_setopt(
		$access,
		CURLOPT_URL,
		"https://id.twitch.tv/oauth2/token?client_id=$client_id&client_secret=$client_secret&grant_type=client_credentials"
	);
	curl_setopt($access, CURLOPT_POST, true);
	curl_setopt($access, CURLOPT_RETURNTRANSFER, true);
	$access_response = json_decode(curl_exec($access), true);
	$access_token = $access_response['access_token'];
	update_field("api_twitch_access_token", $access_token, "option");
	curl_close($access);
	return $access_token;
}

function getChannels($client_id, $access_token, $users_array)
{
	$channels = curl_init();
	curl_setopt(
		$channels,
		CURLOPT_URL,
		"https://api.twitch.tv/helix/streams?user_login=" .
			implode("&user_login=", $users_array)
	);
	curl_setopt($channels, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($channels, CURLOPT_HTTPHEADER, [
		"Client-ID: $client_id",
		"Authorization: Bearer $access_token",
	]);
	$return = json_decode(curl_exec($channels));
	curl_close($channels);
	return $return;
}

$context['twitch_data'] = [];

if ($client_id && $client_secret) {
	if ($access_token) {
		// We got a token, let's try it...
		$stream_data = getChannels($client_id, $access_token, $users_array);
		if ($stream_data !== null) {
			// We got something?
			$context['twitch_data'] = $stream_data;
		} else {
			// We didn't get nuffin, try refreshing the token and going again...
			$access_token = getAccessToken($client_id, $client_secret);
			$stream_data = getChannels($client_id, $access_token, $users_array);
			$context['twitch_data'] = $stream_data;
		}
	} else {
		$access_token = getAccessToken($client_id, $client_secret);
		$stream_data = getChannels($client_id, $access_token, $users_array);
		$context['twitch_data'] = $stream_data;
	}
}

$context['twitch_usernames'] = $users_array;

Timber::render('page-stream-team.twig', $context);
