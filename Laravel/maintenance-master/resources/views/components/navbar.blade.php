@inject('htmlbuilder', 'html')
#{{ $attributes = $htmlbuilder->decorate($navbar->attributes ?: [], ['class' => 'navbar navbar-default', 'role' => 'navigation']) }}

<nav{!! $htmlbuilder->attributes($attributes) !!}>

    <div class="container">

        <div class="navbar-header">

            <button type="button" class="navbar-toggle" data-toggle="collapse"
                    data-target=".{!! $navbar->id !!}-responsive-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <a href="{!! $navbar->url !!}" class="navbar-brand">
                {!! $navbar->title !!}
            </a>

        </div>

        <div class="collapse navbar-collapse {!! $navbar->id !!}-responsive-collapse">
            {!! $navbar->left !!}
            {!! $navbar->right !!}
            {!! $navbar->menu !!}
        </div>

    </div>

</nav>
