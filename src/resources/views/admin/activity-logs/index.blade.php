<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Activity Logs
            </h2>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 py-6">
        <form method="GET" class="bg-white rounded-lg shadow p-4 mb-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-3">
                <div>
                    <label class="text-sm text-gray-600">Search</label>
                    <input name="search" value="{{ request('search') }}"
                           class="w-full border rounded px-3 py-2"
                           placeholder="description / model / causer type">
                </div>

                <div>
                    <label class="text-sm text-gray-600">Log name</label>
                    <select name="log_name" class="w-full border rounded px-3 py-2">
                        <option value="">All</option>
                        @foreach($logNames as $name)
                            <option value="{{ $name }}" @selected(request('log_name')===$name)>{{ $name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="text-sm text-gray-600">Event</label>
                    <select name="event" class="w-full border rounded px-3 py-2">
                        <option value="">All</option>
                        @foreach($events as $event)
                            <option value="{{ $event }}" @selected(request('event')===$event)>{{ $event }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="flex items-end gap-2">
                    <button class="px-4 py-2 rounded bg-black text-white">Filter</button>
                    <a href="{{ route('admin.activity-logs.index') }}" class="px-4 py-2 rounded border">Reset</a>
                </div>
            </div>
        </form>

        <div class="bg-white rounded-lg shadow overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 text-gray-700">
                <tr>
                    <th class="text-left p-3">Time</th>
                    <th class="text-left p-3">Log</th>
                    <th class="text-left p-3">Event</th>
                    <th class="text-left p-3">Description</th>
                    <th class="text-left p-3">Causer</th>
                    <th class="text-left p-3">Subject</th>
                    <th class="text-left p-3">Props</th>
                </tr>
                </thead>
                <tbody>
                @forelse($logs as $log)
                    <tr class="border-t">
                        <td class="p-3 whitespace-nowrap">
                            {{ optional($log->created_at)->format('Y-m-d H:i:s') }}
                        </td>
                        <td class="p-3">{{ $log->log_name }}</td>
                        <td class="p-3">{{ $log->event }}</td>
                        <td class="p-3">{{ $log->description }}</td>
                        <td class="p-3">
                            @if($log->causer)
                                {{ class_basename($log->causer_type) }} #{{ $log->causer_id }}
                                @if($log->causer->name ?? false)
                                    — {{ $log->causer->name }}
                                @endif
                            @else
                                -
                            @endif
                        </td>
                        <td class="p-3">
                            @if($log->subject_type)
                                {{ class_basename($log->subject_type) }} #{{ $log->subject_id }}
                            @else
                                -
                            @endif
                        </td>
                        <td class="p-3">
                            <details class="cursor-pointer">
                                <summary class="text-blue-600">view</summary>
                                <pre class="text-xs bg-gray-50 p-2 rounded overflow-auto">{{ json_encode($log->properties, JSON_PRETTY_PRINT|JSON_UNESCAPED_SLASHES) }}</pre>
                            </details>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="p-6 text-center text-gray-500">No logs found.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $logs->links() }}
        </div>
    </div>
</x-app-layout>
