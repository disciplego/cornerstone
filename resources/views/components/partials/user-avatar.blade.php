@props([
    'user' => auth()->user(),
])

<div
    {{
        $attributes->class([
            'h-10 w-10 rounded-full bg-gray-200 bg-cover bg-center',
            'dark:bg-gray-900' => config('filament.dark_mode'),
        ])
    }}
    style="
        background-image: url('{{ \Filament\Facades\Filament::getUserAvatarUrl($user) ?? 'https://ui-avatars.com/api/?name='.urlencode($user->name)}}');
    "
></div>
