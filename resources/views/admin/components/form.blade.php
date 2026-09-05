@props(['action', 'method' => 'POST', 'model' => null, 'fields' => [], 'title' => null, 'cancelUrl' => null, 'gridCols' => 1])

<div class="max-w-4xl mx-auto">
    @if($title)
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-900">{{ $title }}</h1>
        </div>
    @endif

    <form action="{{ $action }}" 
          method="POST" 
          enctype="multipart/form-data"
          class="ajax-form bg-white rounded-lg shadow-sm border border-gray-200 p-6 space-y-6">
        @csrf
        @if($method !== 'POST')
            @method($method)
        @endif

        <div class="grid grid-cols-{{ $gridCols }} gap-6">
        @foreach($fields as $field)
            @php
                $fieldName = $field['name'];
                $fieldType = $field['type'] ?? 'text';
                $fieldLabel = $field['label'] ?? ucfirst(str_replace('_', ' ', $fieldName));
                $fieldValue = old($fieldName, $model ? ($model->{$fieldName} ?? '') : ($field['default'] ?? ''));
                $fieldRequired = $field['required'] ?? false;
                $fieldOptions = $field['options'] ?? [];
                $fieldRows = $field['rows'] ?? 4;
                $fieldPlaceholder = $field['placeholder'] ?? '';
                $fieldHelp = $field['help'] ?? null;
                $colspan = $field['colspan'] ?? ($fieldType === 'textarea' && $fieldRows > 3 ? $gridCols : 1);
            @endphp

            <div class="{{ $colspan == $gridCols ? 'col-span-' . $gridCols : 'col-span-1' }}">
                <label for="{{ $fieldName }}" class="block text-sm font-medium text-gray-700 mb-2">
                    {{ $fieldLabel }}
                    @if($fieldRequired)
                        <span class="text-red-500">*</span>
                    @endif
                </label>

                @if($fieldType === 'textarea')
                    <textarea id="{{ $fieldName }}" 
                              name="{{ $fieldName }}" 
                              rows="{{ $fieldRows }}"
                              @if($fieldRequired) required @endif
                              placeholder="{{ $fieldPlaceholder }}"
                              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition">{{ $fieldValue }}</textarea>
                
                @elseif($fieldType === 'select')
                    <select id="{{ $fieldName }}" 
                            name="{{ $fieldName }}"
                            @if($fieldRequired) required @endif
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition">
                        <option value="">Pilih {{ $fieldLabel }}</option>
                        @foreach($fieldOptions as $optionValue => $optionLabel)
                            <option value="{{ $optionValue }}" {{ $fieldValue == $optionValue ? 'selected' : '' }}>
                                {{ $optionLabel }}
                            </option>
                        @endforeach
                    </select>
                
                @elseif($fieldType === 'checkbox')
                    <div class="flex items-center">
                        <input type="checkbox" 
                               id="{{ $fieldName }}" 
                               name="{{ $fieldName }}" 
                               value="1"
                               {{ $fieldValue ? 'checked' : '' }}
                               class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                        <label for="{{ $fieldName }}" class="ml-2 block text-sm text-gray-700">
                            {{ $field['checkbox_label'] ?? $fieldLabel }}
                        </label>
                    </div>
                
                @elseif($fieldType === 'file')
                    @if($model && $model->{$fieldName})
                        <div class="mb-2">
                            <img src="{{ asset('storage/' . $model->{$fieldName}) }}" 
                                 alt="Current {{ $fieldLabel }}" 
                                 class="w-32 h-32 object-cover rounded-lg border border-gray-200">
                        </div>
                    @endif
                    <input type="file" 
                           id="{{ $fieldName }}" 
                           name="{{ $fieldName }}" 
                           accept="{{ $field['accept'] ?? '*' }}"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition">
                
                @elseif($fieldType === 'date' || $fieldType === 'datetime-local')
                    <input type="{{ $fieldType }}" 
                           id="{{ $fieldName }}" 
                           name="{{ $fieldName }}" 
                           value="{{ $fieldType === 'datetime-local' && $fieldValue ? \Carbon\Carbon::parse($fieldValue)->format('Y-m-d\TH:i') : $fieldValue }}"
                           @if($fieldRequired) required @endif
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition">
                
                @else
                    <input type="{{ $fieldType }}" 
                           id="{{ $fieldName }}" 
                           name="{{ $fieldName }}" 
                           value="{{ $fieldValue }}"
                           @if($fieldRequired) required @endif
                           placeholder="{{ $fieldPlaceholder }}"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition">
                @endif

                @if($fieldHelp)
                    <p class="mt-1 text-sm text-gray-500">{{ $fieldHelp }}</p>
                @endif

                @error($fieldName)
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        @endforeach
        </div>

        <div class="flex justify-end space-x-4 pt-4 border-t border-gray-200">
            @if($cancelUrl)
                <a href="{{ $cancelUrl }}" 
                   class="px-6 py-2.5 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition font-medium">
                    Cancel
                </a>
            @endif
            <button type="submit" 
                    class="px-6 py-2.5 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition font-medium shadow-sm">
                {{ $model ? 'Update' : 'Create' }}
            </button>
        </div>
    </form>
</div>

