@props([
    'type' => 'button',
    'variant' => 'white',
    'size' => 'md',
    'disabled' => false
])

@php
  $baseClasses =
      'font-medium transition duration-75 ease-in-out focus:outline-none focus:ring-2 focus:ring-opacity-50';

  $variantClasses = [
      'none' => '',
      'primary' =>
          'relative overflow-hidden transition-all before:ease before:absolute before:right-0 before:top-0 before:h-12 before:w-6 before:translate-x-12 before:rotate-6 before:bg-white before:opacity-30 before:duration-700 hover:before:-translate-x-40 bg-primary text-white focus:ring-primary',
      'secondary' => 'bg-secondary text-white hover:bg-opacity-80 focus:ring-secondary',
      'white' => 'bg-white text-white border border-gray-300 hover:bg-gray-50 focus:ring-gray-500',
      'ghost' => 'bg-transparent text-gray-700 hover:bg-gray-100 focus:ring-gray-500',
      'danger' =>
          'relative overflow-hidden transition-all bg-red-600 text-white before:ease before:absolute before:right-0 before:top-0 before:h-12 before:w-6 before:translate-x-12 before:rotate-6 before:bg-white before:opacity-30 before:duration-700 hover:before:-translate-x-40 focus:ring-red-500',
      'outline' =>
          'relative overflow-hidden border-[var(--primary-color)] text-gray-700 before:absolute before:bottom-0 before:left-0 before:top-0 before:z-0 before:h-full before:w-0 before:bg-[var(--primary-color)] before:transition-all before:duration-500 before:bg-[var(--primary-color)] before:duration-300 before:ease-out hover:text-white hover:before:h-full hover:before:w-full hover:before:left-0 border'
  ];

  $sizeClasses = [
      'none' => '',
      'sm' => 'px-4 py-2 rounded-lg',
      'md' => 'px-6 py-3 rounded-lg',
      'lg' => 'px-8 py-4 rounded-lg'
  ];

  // component defaults
  $componentClasses = implode(' ', [
      $baseClasses,
      $variantClasses[$variant] ?? $variantClasses['white'],
      $sizeClasses[$size] ?? $sizeClasses['md'],
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
  <span class="relative z-10">
    {{ $slot }}
  </span>
</button>
