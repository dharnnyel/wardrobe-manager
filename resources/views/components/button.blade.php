@props([
    'type' => 'button',
    'variant' => 'primary',
    'size' => 'md',
    'disabled' => false
])

@php
  $baseClasses =
      'font-medium transition focus:outline-none focus:ring-2 focus:ring-opacity-50 rounded-lg';

  $variantClasses = [
      'none' => '',
      'primary' => 'bg-primary text-white hover:bg-purple-700',
      'secondary' => 'bg-secondary text-white hover:bg-opacity-80',
      'ghost' => 'bg-transparent text-gray-700 hover:bg-gray-100',
      'danger' =>
          'bg-red-400 text-white hover:bg-red-500 focus:ring-red-500',
      'outline' =>
          'border border-gray-300 bg-white text-gray-700 hover:bg-gray-50'
  ];

  $sizeClasses = [
      'none' => '',
      'small' => 'px-4 py-2',
      'medium' => 'px-6 py-3',
      'large' => 'px-8 py-4'
  ];

    // component defaults
  $componentClasses = implode(' ', [
      $baseClasses,
      $variantClasses[$variant] ?? $variantClasses['primary'],
      $sizeClasses[$size] ?? $sizeClasses['medium'],
      $disabled ? 'opacity-50 cursor-not-allowed' : ''
  ]);

  // capture any classes passed by the consumer and remove them from $attributes
  $userClasses = $attributes->get('class') ?? '';
  $attributes = $attributes->except('class');

  // append user classes so they can override where appropriate
  $classes = trim($componentClasses . $userClasses);
@endphp

<button {{ $disabled ? 'disabled' : '' }} {{ $attributes->merge(['class' => $classes]) }}
  type="{{ $type }}">
  {{ $slot }}
</button>
