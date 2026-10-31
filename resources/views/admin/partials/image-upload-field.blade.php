@php
  $fieldId = str_replace(['[', ']'], '_', $name);
  // Generate proper preview URL
  if ($value) {
    if (str_starts_with($value, 'http')) {
      $previewUrl = $value;
    } elseif (str_starts_with($value, '/assets')) {
      $previewUrl = url($value);
    } elseif (str_starts_with($value, '/storage')) {
      $previewUrl = url($value);
    } elseif (str_starts_with($value, '/uploads')) {
      $previewUrl = url($value);
    } else {
      $previewUrl = url('/storage/' . $value);
    }
  } else {
    $previewUrl = '';
  }
@endphp
<div class="image-upload-group">
  <label class="block text-sm font-medium text-gray-700 mb-2">{{ $label }}</label>
  <input type="hidden" name="{{ $name }}" id="{{ $fieldId }}" value="{{ $value }}" />

  <div class="relative w-32 h-32 border-2 border-dashed border-gray-300 rounded-lg overflow-hidden bg-gray-50 cursor-pointer hover:border-blue-400" onclick="document.getElementById('{{ $fieldId }}_file').click()">
    {{-- Preview Image --}}
    <img id="{{ $fieldId }}_preview"
         src="{{ $previewUrl }}"
         alt="Preview"
         style="display: {{ $value ? 'block' : 'none' }}; width: 100%; height: 100%; object-fit: cover;" />

    {{-- Upload Placeholder --}}
    <div id="{{ $fieldId }}_placeholder" style="display: {{ $value ? 'none' : 'flex' }}; position: absolute; inset: 0; flex-direction: column; align-items: center; justify-content: center;">
      <i class="fas fa-cloud-upload-alt" style="font-size: 24px; color: #9ca3af; margin-bottom: 4px;"></i>
      <span style="font-size: 12px; color: #6b7280;">Upload</span>
    </div>
  </div>

  <input type="file" id="{{ $fieldId }}_file" class="image-file-input" data-target="{{ $fieldId }}" accept="image/*" style="display: none;" />

  <div class="mt-1">
    <span id="{{ $fieldId }}_name" style="font-size: 12px; color: #6b7280; display: block; max-width: 128px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
      @if($value)
        {{ basename($value) }}
      @else
        No file selected
      @endif
    </span>
  </div>
</div>

