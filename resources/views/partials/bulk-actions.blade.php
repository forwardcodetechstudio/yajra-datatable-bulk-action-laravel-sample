<form id="action_form">
    @csrf
    <input type="hidden" id="selected_rows" name="selected_rows" value="">
    <div class="row">
        <div class="col-2 form-group">
            <select id="bulk_actions" class="form-control" name="bulk_actions" required>
                <option value="" selected disabled>Bulk actions</option>
                @if (isset($bulk_actions) && sizeof($bulk_actions) > 0)
                    @foreach ($bulk_actions as $bulk_action)
                        <option value="{{ $bulk_action['value'] }}" data-url="{{ $bulk_action['url'] }}"
                            data-method="{{ $bulk_action['method'] }}"
                            data-confirm-message="{{ $bulk_action['confirm-message'] }}"
                            data-confirm-button-label="{{ $bulk_action['confirm-button-label'] }}">
                            {{ $bulk_action['label'] }}</option>
                    @endforeach
                @endif
            </select>
        </div>
        <div id="status-wrapper" class="col-2 form-group" style="display:none">
            <select id="status" class="form-control" name="status">
                <option value="" selected disabled>Select Status</option>
                <option value="active">Active</option>
                <option value="inactive">Inactive</option>
            </select>
        </div>
        <div class="col-2 form-group">
            <button id="apply_btn" class="btn btn-secondary" type="submit">Apply</button>
        </div>
    </div>
</form>
