@extends ('layouts.dashboard.master')

@section ('content')

  <header class="page-header">
    <div class="container-fluid">
      <h2 class="no-margin-bottom">Manage SMS</h2>
    </div>
  </header>
  
  @include('layouts.errors')

  <div class="row incon">

  <div class="col-md-6 col-sm-6">
    <div class="card">

      <div class="container-fluid no-margin">
        <div class="row pad-top">
          <div class="col-md-12 col-sm-12">
            <h2><i class="fa fa-archive"></i>&nbsp SMS Feature &nbsp

            </h2>
          </div>
        </div> 
      </div>

      <div class="container-fluid no-margin">
        <div class="row pad-top folder-container">
            {{-- here goes folder table --}}
        </div>

        <div class="row pad-top">
          <div class="col-md-12 text-center">

          </div>
        </div>

      </div>
    </div>
    {{-- end of card --}}

    <div class="card">
      <div class="container-fluid no-margin">
        <div class="row pad-top">
          <div class="col-md-12 col-sm-12">
            <h2><i class="fa fa-mobile"></i> &nbsp Text Msg Form
            </h2>

              <form action="#" class="pad-top">
                
                  <div class="form-group">
                    <label for="num">Number : </label>
                    <input name="num" type="text" placeholder="Ex. 639074239579" class="form-control form-control-sm">
                  </div>

                  <div class="form-group">
                    <label for="body">Body Text : </label>
                    <textarea name="body" id="body" cols="20" rows="5" class="form-control form-control-sm" maxlength="130">
                    </textarea>
                  </div>

                  <div class="form-group">
                   <button type="submit" class="btn btn-primary"> 
                      <i class="fa fa-paper-plane"></i> &nbsp Send
                   </button>
                  </div>

              </form>
              
            
          </div>
        </div>
      </div>
    </div>
  </div>
  {{-- end of col --}}
  
  <div class="col-md-6 col-sm-6">

    <div class="card">
      <div class="card-header">
        <h2><i class="fa fa-globe"></i>&nbsp Blast &nbsp
            <button class="btn btn-info btn-sm float-right editSms" value="{{ $sms[0]->id }}">
            <i class="fa fa-edit"></i></button> 
        </h2>
      </div>
      <div class="container-fluid no-margin">
        <div class="row pad-top">
          <div class="col-md-3 col-sm-3">
            <button class="btn btn-primary sendSms" value="{{ $sms[0]->id }}">
              <i class="fa fa-paper-plane"></i>&nbsp Send
            </button>
          </div>
          <div class="col-md-9 col-sm-9">
            <p><b>Msg :</b> {{ $sms[0]->body }}</p>
          </div>
        </div> 
      </div>
    </div>

    <div class="card">
      <div class="card-header">
        <h2><i class="fa fa-user-secret"></i>&nbsp Admin &nbsp
            <button class="btn btn-info btn-sm float-right editSms" value="{{ $sms[1]->id }}">
              <i class="fa fa-edit"></i></button> 
        </h2>
      </div>
      <div class="container-fluid no-margin">
        <div class="row pad-top">
          <div class="col-md-3 col-sm-3">
            <button class="btn btn-primary sendSms" value="{{ $sms[1]->id }}">
              <i class="fa fa-paper-plane"></i>&nbsp Send
            </button>
          </div>
          <div class="col-md-9 col-sm-9">
            <p><b>Msg :</b> {{ $sms[1]->body }}</p>
          </div>
        </div> 
      </div>
    </div>

    <div class="card">
      <div class="card-header">
        <h2><i class="fa fa-users"></i>&nbsp User &nbsp
            <button class="btn btn-info btn-sm float-right editSms" value="{{ $sms[2]->id }}">
              <i class="fa fa-edit"></i></button> 
        </h2>
      </div>
      <div class="container-fluid no-margin">
        <div class="row pad-top">
          <div class="col-md-3 col-sm-3">
              <button class="btn btn-primary sendSms" value="{{ $sms[2]->id }}">
                <i class="fa fa-paper-plane"></i>&nbsp Send
              </button>
          </div>
          <div class="col-md-9 col-sm-9">
            <p><b>Msg :</b> {{ $sms[2]->body }}</p>
          </div>
        </div> 
      </div>
    </div>


    <div class="card">
    
      <div class="container-fluid no-margin">
        <div class="row pad-top">
          <div class="col-md-7 col-sm-7">
            <h2><i class="fa fa-user-plus"></i>&nbsp Custom &nbsp

            </h2>
          </div>
        </div> 
      </div>

      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12 col-sm-12">

          </div>
        </div>
      </div>
    </div>

  </div>
  </div>

  {{-- MODALS --}}

  @component('layouts.dashboard.sm-modal')
    @slot ('id')
      editSms
    @endslot

    @slot ('title')
      <div class="text-info post-user text-lg title">
         
      </div>
    @endslot

    @slot ('modalBody') 
    <form id="smsForm" action="" method="POST">
    <div class="row">
      <div class="col-md-10 offset-md-1">
        <input id="method" type="hidden" name="_method" value="">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="form-group">
          <textarea id="bodyEdit" type="text" name="body" class="form-control form-control-sm" placeholder="Container Name" maxlength="50"></textarea>
        </div>
      </div>
    </div>

    <div class="text-center">
      <button type="submit" class="btn btn-info">Update</button>
      <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
    </div>
      <hr>
    </form>
    @endslot

    @slot ('modalFooter')
    @endslot
  @endcomponent

  @component('layouts.dashboard.modal')
    @slot ('id')
      uploadFile
    @endslot

    @slot ('title')
      <div class="text-info post-user">
        <i class="fa fa-cloud-upload"></i> &nbsp File Upload
      </div>
    @endslot

    @slot ('modalBody') 
    <form action="/file/create" method="POST" enctype="multipart/form-data" id="upload">
      <input type="hidden" name="_token" value="{{ csrf_token() }}">
      <div class="row">
        <div class="col-md-10 offset-md-1">
          <div class="row">
          <div class="col-md-6">
            <input type="file" name="file[]" multiple="true" class="form-control form-control-sm">
          </div>

          <div class="col-md-6">
            <select name="folders" id="folders" class="custom-select folders">
              
            </select>
          </div>
          </div>
        </div>
      </div>

      <div class="text-center pad-top">
        <button type="submit" class="btn btn-info">Upload</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>

    </form>
    @endslot

    @slot ('modalFooter')
    @endslot
  @endcomponent

  @component('layouts.dashboard.sm-modal')
    @slot ('id')
      deleteFolder
    @endslot

    @slot ('title')
      <i class="fa fa-asterisk text-danger"></i> Proceed with caution!
      Do you want to delete ALL Folders? Are you sure?
    @endslot

    @slot ('modalBody') 
    <div class="row">
        <div class="col-md-12 col-sm-12">
          <form action="/folder/deleteAll" method="POST">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <button class="btn btn-danger" type="submit">Yes</button>
            <button type="button" class="btn btn-secondary no" data-dismiss="modal">No</button>
          </form>
          {{-- {{ Form::open(['action' => ['UserController@destruction', ''], 'method' => 'POST']) }} --}}
            {{-- {{ Form::button('Yes', ['type' => 'submit', 'class' => 'btn btn-danger']) }} --}}
          {{-- {{ Form::close() }} --}}
        </div>
      </div>
    @endslot

    @slot ('modalFooter')
    @endslot
  @endcomponent


@endsection

@section ('scripts')
  <script src="{{ asset('js/master.js') }}"></script>
  <script src="{{ asset('js/admin/sms.js') }}"></script>
@endsection