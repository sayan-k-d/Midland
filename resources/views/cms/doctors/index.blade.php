@extends('cms.layout.admin')
@section('title', 'Department')
@section('content')
    @php
        $columns = [
            'id' => '#',
            'doctor_name' => 'Name',
            'phone' => 'Phone',
            'email' => 'Email',
            'image' => 'Image',
            'doctor_post' => 'Post',
            'department' => 'Department',
            'biography' => 'Biography',
            'education' => 'Education',
            'experience' => 'Experience',
            'languages' => 'Languages',
            'address' => 'Address',
            'workingSchedules' => 'Working Hours',
            'degree' => 'Degree',
            'isHead' => 'Head of the Department',
        ];

    @endphp
    <div class="mt-3 main-container">
        <div class="d-flex align-items-center justify-content-between admin-details">
            {{-- <h3> Department Details</h3> --}}
            <h2 class="text-center my-4 text-uppercase fw-bold flex-grow-1">Doctor Details</h2>
            <div><a class="btn btn-success" href="/addDoctor">Add Doctor</a></div>
        </div>

        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead class="table-dark">
                    <tr>
                        @foreach ($columns as $column)
                            <th scope="col" class="{{ $wrapContent ?? false ? '' : 'text-nowrap' }}">{{ $column }}
                            </th>
                        @endforeach
                        <th scope="col" class="text-center ">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($doctors as $row)
                        <tr>
                            @foreach ($columns as $key => $column)
                                <td class="{{ $wrapContent ?? false || $key != 'department' ? '' : 'text-nowrap' }}">
                                    @if (strtolower($column) == 'phone')
                                        @php
                                            $phones = explode(',', $row['phone']);
                                        @endphp
                                        @foreach ($phones as $phone)
                                            <p>{{ $phone }}</p>
                                        @endforeach
                                    @elseif(strtolower($column) == 'department')
                                        @foreach ($departments as $department)
                                            @if ($department->id == $row['department'])
                                                {{ $department->department_name }}
                                            @endif
                                        @endforeach
                                    @elseif (strtolower($column) == 'education')
                                        @php
                                            $educations = explode(',', $row[$key]);
                                        @endphp
                                        @foreach ($educations as $education)
                                            <p>{{ $education }}</p>
                                        @endforeach
                                    @elseif($key == 'workingSchedules')
                                        @php
                                            $schedules = explode(',', $row[$key]);
                                        @endphp
                                        @foreach ($schedules as $schedule)
                                            <p>{{ $schedule }}</p>
                                        @endforeach
                                    @elseif (strtolower($column) == 'image')
                                        @if (!empty($row[$key]))
                                            <img src="{{ $row[$key] }}" alt="Department Image"
                                                style="max-width: 50px; height: auto;">
                                        @else
                                            No Image
                                        @endif
                                    @elseif($key == 'isHead')
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

                            <td class="text-center">
                                <div class="d-flex gap-2 justify-content-center">
                                    <a href="/doctors/edit/{{ $row['id'] }}" class="btn btn-warning text-uppercase">
                                        Edit
                                    </a>
                                    <form action="/doctors/delete/{{ $row['id'] }}" method="POST"
                                        onsubmit="return confirm('Are you sure you want to delete this service?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger text-uppercase">
                                            Delete
                                        </button>
                                    </form>

                                </div>
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
            @if ($totalDoctors > $maxPageLimit)
                <div class="text-center pagination-container">
                    {{ $doctors->links() }}
                </div>
            @endif
        </div>

    </div>



@endsection
