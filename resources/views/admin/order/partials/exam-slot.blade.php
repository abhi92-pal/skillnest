@forelse($examslots as $examslot)
    <tr>
        <td>
            {{ date('d/m/Y h:i A', strtotime($examslot->starts_at)) }}
        </td>
        <td>{{ $examslot->max_candidate }}</td>
        <td>{{ $examslot->rem_seat }}</td>
        <td>
            <a href="javascript:void(0)" class="btn btn-primary btn-sm edit_slot" 
                data-starts_at="{{ date('Y-m-d H:i:s', strtotime($examslot->starts_at)) }}"
                data-id="{{ $examslot->id }}"
                data-max_candidate="{{ $examslot->max_candidate }}"
            >
                <i class="fa fa-pen"></i> Edit
            </a>
            <a href="javascript:void(0)" class="btn btn-danger btn-sm delete_item" data-url="{{ route('admin.examslot.destroy', $examslot->id) }}">
                <i class="fa fa-trash-alt"></i> Delete
            </a>
        </td>
    </tr>
@empty
    <tr>
        <td colspan="4">
            No exam slot set
        </td>
    </tr>
@endforelse