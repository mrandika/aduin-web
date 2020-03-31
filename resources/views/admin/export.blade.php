<table>
    <thead>
        <tr>
            <td>ID</td>
            <td>Title</td>
            <td>Pelapor</td>
            <td>Instansi yang dilapor</td>
            <td>Status Laporan</td>
        </tr>
    </thead>
    <tbody>
        @foreach ($reports as $report)
        <tr>
            <td>{{ $report->id }}</td>
            <td>{{ $report->title }}</td>
            <td>
                {{ $report->user->username }}
            </td>
            <td>
                {{ $report->instance->name }}
            </td>
            <td>{{ $report->status }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
