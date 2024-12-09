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
                        @elseif($key == 'is_active')
                            @if ($row[$key] == 1)
                                Yes
                            @else
                                No
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
                                @if ($action['label'] === 'view')
                                    <button type="button" class="btn {{ $action['class'] }}" data-bs-toggle="modal"
                                        data-bs-target="#exampleModal" title="View Details"
                                        data-row="{{ json_encode($row) }}">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                @elseif ($action['label'] === 'Delete')
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

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">{{ $modalTitle ?? '' }}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="modalContent" class="card" style="transform: none">
                    <div class="card-body" id="dynamicModalContent">

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", () => {
        const exampleModal = document.getElementById("exampleModal");

        exampleModal.addEventListener("show.bs.modal", (event) => {
            const button = event.relatedTarget; // Button that triggered the modal
            const rowData = JSON.parse(button.getAttribute("data-row")); // Parse row data from data-row

            const modalBody = document.getElementById("dynamicModalContent");
            modalBody.innerHTML = "";
            // Populate modal with row data
            for (const [key, value] of Object.entries(rowData)) {
                if (key === "id" || key === 'created_at' || key === 'updated_at' || key ===
                    'department_id')
                    continue; // Skip ID field
                const field = document.createElement("p");
                field.className = "card-text mb-2";
                field.innerHTML =
                    `<strong>${key.replace(/_/g, " ").toUpperCase()}:</strong> ${value || "N/A"}`;
                modalBody.appendChild(field);
            }
        });
    });
</script>
