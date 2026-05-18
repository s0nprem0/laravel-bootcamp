<!DOCTYPE html>
<html lang="en" data-theme="lofi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chirper - Home</title>
    <link rel="preconnect" href="<https://fonts.bunny.net>">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css" />
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5/themes.css" rel="stylesheet" type="text/css" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen flex flex-col bg-base-200 font-sans">

	<x-layout>
		<x-slot:title>
			Welcome
		</x-slot:title>

		<div class="max-w-2xl mx-auto">
			@foreach ($chirps as $chirp)
			<div class="card bg-base-100 shadow mt-8">
				<div class="card-body">
					<div>
						<h1 class="text-3xl font-bold mb-4">{{ $chirp['author'] }}</h1>
						<p class="text-lg text-gray-700 mb-6">{{ $chirp['message'] }}</p>
						<p class="text-sm text-gray-500">{{ $chirp['time'] }}</p>
					</div>
				</div>
			</div>
			@endforeach
		</div>
	</x-layout>
</body>

</html>
