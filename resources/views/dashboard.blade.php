<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Dashboard Lowongan Kerja') }}
            </h2>
            <a href="{{ route('jobs.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                + Pasang Lowongan
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <strong class="font-bold">Berhasil!</strong>
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    <h3 class="text-lg font-bold mb-4">Lowongan Terbaru</h3>

                    @if($jobs->count() > 0)
                        <div class="grid gap-4">
                            @foreach($jobs as $job)
                                <div class="border p-4 rounded-lg hover:bg-gray-50 transition">
                                    <h4 class="text-xl font-bold text-blue-600">{{ $job->title }}</h4>
                                    <p class="text-gray-600 font-semibold">{{ $job->company }} - {{ $job->location }}</p>
                                    @if($job->salary)
                                        <p class="text-green-600 font-bold">Rp {{ number_format($job->salary, 0, ',', '.') }}</p>
                                    @endif
                                    <p class="mt-2 text-gray-700">{{ Str::limit($job->description, 100) }}</p>
                                    <div class="mt-3 text-sm text-gray-400">
                                        Diposting {{ $job->created_at->diffForHumans() }}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-500 text-center py-10">Belum ada lowongan kerja yang tersedia.</p>
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>