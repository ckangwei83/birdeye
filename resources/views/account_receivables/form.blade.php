@extends('layouts.tenant')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-md-center">
            <div class="col-md-8">
                <div class="card ">
                    <div class="card-header card-header-primary card-header-icon">
                        <div class="card-icon">
                            <i class="material-icons">{{ config("tablecolumns.account_receivables.icon") }}</i>
                        </div>
                        <h4 class="card-title card-inline">Account Receivable</h4>
                        <a href="{{ route('account_receivables.index') }}" class="btn btn-link btn-primary pull-right">&lt;&lt; Back to list</a>
                    </div>
                    <div class="card-body ">
                        <form id="AccountReceivableForm" method="post" action="{{ route('account_receivables.'.$action, $input) }}">
                            {{ csrf_field() }}
                            @if($action == 'store')
                            {{ method_field('POST') }}
                            @elseif($action == 'update')
                            {{ method_field('PUT') }}
                            @endif
                            @include('layouts.form')
                            <button class="btn btn-fill btn-primary" id="btnNewEntity">
                                @if($action == 'store')
                                Create
                                @elseif($action == 'update')
                                Update
                                @endif
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
