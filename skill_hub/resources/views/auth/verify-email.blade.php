@extends('web.layout')

@section('title')
    Verify Email
@endsection

@section('main')
    <div class="alert alert-success">
        {{__('web.verifMsg')}}
    </div>
    <div id="contact" class="section">

        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <div class="contact-form">
                        <form action="{{url('email/verification-notification')}}" method="post">
                            @csrf
                            <button type="submit" class="main-button icon-button pull-right">
                                {{__('web.resendemail')}}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
