@extends('layouts.buttons.dropdown')

@section('dropdown.body.content')
    <li>
        <a href="
        {{
            route('maintenance.inventory.stocks.movements.show', [
                $item->id,
                $stock->id,
                $movement->id
            ])
        }}
                ">
            <i class="fa fa-search"></i> View Movement
        </a>
    </li>
    <li>
        <a
                href="
                {{
                    route('maintenance.inventory.stocks.movements.rollback', [
                        $item->id,
                        $stock->id,
                        $movement->id
                    ])
                }}
                        "
                data-method="post"
                data-token="{{ csrf_token() }}"
                data-message="Are you sure you want to roll back this movement?">
            <i class="fa fa-refresh"></i> Rollback Movement
        </a>
    </li>
@overwrite
