---
status: draft
---

{% from './fractalMacros.njk' import fractalColoursSingle %}

## Primary brand colours

{{ fractalColoursSingle(tokens.colors | theoTokenCategory('palette-brand')) }}

## Generic colours

{{ fractalColoursSingle(tokens.colors | theoTokenCategory('palette-generic')) }}

## Neutrals

{{ fractalColoursSingle(tokens.colors | theoTokenCategory('palette-neutral')) }}

## Contextual

{{ fractalColoursSingle(tokens.colors | theoTokenCategory('palette-context')) }}
