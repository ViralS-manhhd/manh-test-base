<div data-repeater-item class="outer">

    @if(Module::find('product') && Module::find('product')->isEnabled())
        @component('common-components.forms.select',[
            'options' => $products,
            'props' => ['class' => 'select2'],
        ])
            @slot('field') product_id @endslot
            @slot('label') {{ _t('product') }} @endslot
        @endcomponent
    @endif

    @component('common-components.forms.tables-editable',[
            'groups' => $groups,
            'props' => ['class' => 'select2'],
        ])
        @slot('field') {{ localize_field('name')}} @endslot
        @slot('label') {{ _t('name') }} @endslot
        @slot('placeholder') {{ _t('enter') . ' ' . _t('name') . '...' }} @endslot
    @endcomponent
</div>
