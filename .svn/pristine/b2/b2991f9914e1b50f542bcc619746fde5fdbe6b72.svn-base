@if(isset($data))
    @if($l = count($data))
        <div class="box-body">
            <table id="table" data-toggle="table" data-striped="true">
                @foreach($data as $i =>$row)
                    @if(is_array($row))
                        @if($i == 0)
                            <?php $keys = array_keys( (array)$row);?>
                            <thead>
                            <tr>
                                @foreach($keys as $key)
                                    <th>{{ $key }}</th>
                                @endforeach
                            </tr>
                            </thead>
                        @endif
                        <tr>
                            @foreach($keys as $key)
                                <td>{{ $row[$key] }}</td>
                            @endforeach
                        </tr>
                    @endif
                @endforeach
            </table>
        </div>
    @endif
@endif
