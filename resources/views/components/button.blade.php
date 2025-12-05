@props([
    'type' => 'button',
    'variant' => 'primary',
    'size' => 'md',
    'disabled' => false
])

@php
  $baseClasses = 'font-medium transition duration-75 ease-in-out focus:outline-none focus:ring-2 focus:ring-opacity-50';

  $variantClasses = [
      'none' => '',
      'primary' => 'bg-primary text-white hover:bg-purple-700',
      'secondary' => 'bg-secondary text-white hover:bg-opacity-80',
      'ghost' => 'bg-transparent text-gray-700 hover:bg-gray-100',
      'danger' => 'bg-red-400 text-white hover:bg-red-500 focus:ring-red-500',
      'outline' => 'border border-gray-300 text-gray-700 hover:bg-gray-50'
  ];

  $sizeClasses = [
      'none' => '',
      'small' => 'px-4 py-2 rounded-lg',
      'medium' => 'px-6 py-3 rounded-lg',
      'large' => 'px-8 py-4 rounded-lg'
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

  // merge classes with replacement logic
  $componentArray = array_filter(explode(' ', $componentClasses));
  $userArray = array_filter(explode(' ', $userClasses));
  $classMap = [];
  foreach ($componentArray as $class) {
      $parts = explode('-', $class, 2);
      $prefix = $parts[0] . (count($parts) > 1 ? '-' : '');
      $classMap[$prefix] = $class;
  }
  foreach ($userArray as $class) {
      $parts = explode('-', $class, 2);
      $prefix = $parts[0] . (count($parts) > 1 ? '-' : '');
      $classMap[$prefix] = $class;
  }
  $classes = implode(' ', array_values($classMap));
@endphp

<button {{ $disabled ? 'disabled' : '' }} {{ $attributes->merge(['class' => $classes]) }}
  type="{{ $type }}">
  {{ $slot }}
</button>
