@extends('layouts.material')

@section('content')
<div class="container-fluid" >
    <div class="header text-center">
        <h3 class="title">Evaluation for {{ date("F Y", strtotime($evaluation->code."-01")) }}</h3>
        <p class="category">
            Please make sure all the neccessary documents have been uploaded
        </p>
        <small class="text-muted"><a href="{{ url('evaluation') }}">&lt;&lt; Back to list</a></small>
    </div>

    @include('layouts.messages')

    @foreach($uploads as $index=>$upload)
        @if($index%2 == 0)
        <div class="row">
        @endif
        <?php $model = $upload["model"]; ?>
        <div class="col-md-6">
            @include('evaluation.form_upload')
        </div>
        @if($index%2 == 1 || count($uploads)==($index+1))
        </div>
        @endif
    @endforeach
</div>

<div class="modal fade" id="excel_viewer" tabindex="-1" role="dialog" aria-labelledby="birdeye" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    <i class="material-icons">clear</i>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-sm table-striped" id="excel_table">
                        <thead class=" text-primary"></thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-link" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!--  End Modal -->
@endsection

@push('scripts')
<script>
    $(document).ready(function(){
        $(".view_excel").click(function(){
            val = $(this).data("target");

            $("#excel_viewer .modal-title").html($(this).data("title"));
            $("#excel_viewer #excel_table thead").html('');
            $("#excel_viewer #excel_table tbody").html('');

            $.get("{{ url('evaluation/excel') }}/" + val, function(data){
                $(data.columns).each(function(k,v){
                    v = v.replace(/_/g, " ");
                    $("#excel_viewer #excel_table thead").append("<th>"+v+"</th>");
                });

                $(data.rows).each(function(index,row){
                    tr = $("<tr></tr>");

                    $(data.columns).each(function(k,v){
                        tr.append("<td>"+row[v]+"</td>");
                    });

                    $("#excel_viewer #excel_table tbody").append(tr);
                });

                $("#excel_viewer").modal();
            });
        });
    });
</script>
@endpush

@push('styles')
<style>
    .card-title i.material-icons{
        font-size: 16px;
    }
    .view_excel{
        cursor: pointer;
    }

    #excel_table th{
        text-transform: uppercase;
    }
</style>
@endpush