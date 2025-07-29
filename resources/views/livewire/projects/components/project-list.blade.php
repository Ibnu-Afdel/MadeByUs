  <div class="mt-4">
        @foreach ($projects as $project)
            <div class="border border-blue-400 py-2 m-3 px-2 rounded">
                <div class="font-bold text-blue-200 text-3xl">
                    {{ $project->title }}
                </div>
                <div class="text-blue-300 p-2">
                    {{ $project->description }}
                </div>
            </div>
        @endforeach
    </div>