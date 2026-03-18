<div class="dashboard_common_table table-responsive">
    <table class="table zTable" id="">
        <thead class="table-heading">
            <tr>
                <th scope="col">
                    <div>{{ __('Key') }}</div>
                </th>
                <th scope="col">
                    <div>{{ __('Value') }}</div>
                </th>
                <th scope="col" class="text-end">
                    <div>{{ __('Action') }}</div>
                </th>
            </tr>
        </thead>
        <tbody id="append">
            @forelse ($translators as $key => $value)
            <tr>
                <td>
                    <textarea type="text" class="key primary-form-control" readonly required>{!! $key !!}</textarea>
                </td>
                <td>
                    <input type="hidden" value="0" class="is_new">
                    <textarea type="text" class="val primary-form-control" required>{!! $value !!}</textarea>
                </td>
                <td class="text-end">
                    <button type="button" class="updateLangItem common_button add_new_button">
                        {{ __('Update') }}
                    </button>
                </td>
            </tr>
            @empty

            @endforelse
        </tbody>
    </table>
</div>