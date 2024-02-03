<!-- Simple Tables -->
<div class="card">
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">#Rent Log</h6>
    </div>
    <div class="table-responsive p-3">
        <table class="table align-items-center table-flush table-hover" id="dataTableHover">
            <thead class="thead-light">
                <tr>
                    <th>No.</th>
                    <th>User</th>
                    <th>Book Title</th>
                    <th>Rent Date</th>
                    <th>Return Date</th>
                    <th>Actual Return Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($rentlog as $item)
                    <tr
                        class="{{ $item->actual_return_date == null
                            ? ''
                            : ($item->return_date < $item->actual_return_date
                                ? 'bg-danger text-white'
                                : 'bg-success text-white') }}">
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->user->username }}</td>
                        <td>{{ $item->book->title }}</td>
                        <th>{{ $item->rent_date }}</th>
                        <th>{{ $item->return_date }}</th>
                        <th>{{ $item->actual_return_date }}</th>
                        <th>
                            @if ($item->actual_return_date == null)
                            @else
                                <a href="{{ route('delete.old.rent.logs', ['id' => $item->id]) }}"
                                    class="btn btn-danger btn-sm"
                                    onclick="return confirm('Are you sure you want to delete this record?')">Delete</a>
                            @endif
                        </th>

                    </tr>
                    {{-- <tr>
                                        <td>1</td>
                                        <td>Yucca Ching</td>
                                        <td>Playboy itu suami aku</td>
                                        <th>18 January 2024</th>
                                        <th>21 January 2024</th>
                                        <th>20 January 2024</th>
                                        <td><span class="badge badge-success">Delivered</span></td>
                                        <td><a href="#" class="btn btn-sm btn-primary">Detail</a></td>
                                    </tr> --}}
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="card-footer"></div>
</div>
