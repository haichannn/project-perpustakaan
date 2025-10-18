<div>
    @if (isset($label))
    <label for="{{ $name }}" class="form-label">{{ $label }}</label>
    @endif

    <input
        id="{{ $name }}"
        type="{{ $type }}"
        name="{{ $name }}"
        class="{{ $class }} @if($errors->has($name)) is-invalid @endif"
        placeholder="{{ $placeholder }}"
        value="{{ old($name, isset($value) ? $value : '') }}"

        @if (isset($min)) min="{{ $min }}" @endif
        @if (isset($max)) max="{{ $max }}" @endif
        @if (isset($required) && $required) required @endif
        @if (isset($disabled) && $disabled) disabled @endif
        @if (isset($readonly) && $readonly) readonly @endif />

    @if($errors->has($name))
    <div class="invalid-feedback">
        {{ $errors->first($name) }}
    </div>
    @endif
</div>
