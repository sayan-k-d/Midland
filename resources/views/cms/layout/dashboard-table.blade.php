<table class="table table-striped table-bordered">
    <thead class="table-dark">
        <tr>
            @foreach ($columns as $column)
                <th scope="col" class="{{ $wrapHeaderContent ?? false ? '' : 'text-nowrap' }}">{{ $column }}</th>
            @endforeach
            @if (isset($actions))
                <th scope="col" class="text-center ">Actions</th>
            @endif
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $row)
            <tr>
                @foreach ($columns as $key => $column)
                    <td class="{{ $wrapContent ?? false ? '' : 'text-nowrap' }}">
                        @if (strtolower($column) == 'image')
                            @if (!empty($row[$key]))
                                <img src="{{ $row[$key] }}" alt="Department Image"
                                    style="max-width: 50px; height: auto;">
                            @else
                                No Image
                            @endif
                        @else
                            {{ $row[$key] ?? 'N/A' }}
                        @endif
                    </td>
                    {{-- <!-- <td class="text-nowrap">{{ $row[$key] ?? 'N/A' }}</td> --> --}}
                @endforeach
                @if (isset($actions))
                    <td class="text-center">
                        <div class="d-flex gap-2 justify-content-center">
                            @foreach ($actions as $action)
                                @php
                                    $isDisabled = isset($action['disabled']) && $action['disabled']($row);
                                @endphp
                                @if ($action['label'] === 'Delete')
                                    <form action="{{ route($action['route_name'], $row['id']) }}" method="POST"
                                        onsubmit="return confirm('Are you sure you want to delete this service?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger text-uppercase">
                                            {{ $action['label'] }}
                                        </button>
                                    </form>
                                @else
                                    <a href="{{ $isDisabled ? 'javascript:void(0)' : $action['url']($row['id']) }}"
                                        class="btn {{ $action['class'] }} text-uppercase {{ $isDisabled ? 'disabled' : '' }}"
                                        {{ $isDisabled ? 'disabled' : '' }}>
                                        {{ $action['label'] }}
                                    </a>
                                @endif
                            @endforeach
                        </div>
                    </td>
                @endif
            </tr>
        @endforeach
    </tbody>
</table>
@if ($totalData > $maxPageLimit)
    <div class="text-center pagination-container">
        {{ $data->links() }}
    </div>
@endif
