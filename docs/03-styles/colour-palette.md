---
status: draft
---

{% from './fractalMacros.njk' import fractalColoursSingle %}

## Primary brand colours

{{ fractalColoursSingle(tokens.colors | theoTokenCategory('palette-brand')) }}

## Accent brand colours

{{ fractalColoursSingle(tokens.colors | theoTokenCategory('palette-accent')) }}

## Neutrals

{{ fractalColoursSingle(tokens.colors | theoTokenCategory('palette-neutral')) }}
