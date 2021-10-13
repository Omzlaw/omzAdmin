<!-- Logo Field -->
<div class="col-sm-12 mb-3">
    {{-- {!! Form::label('logo', 'Logo:') !!} --}}
    @if (isset($logo))
        <img height="50" width="50" src="{{ asset($logo) }}" class="img-circle"/>
    @else
        <img src="{{ asset('images/user.png') }}" class="img-circle"/>
    @endif
</div>