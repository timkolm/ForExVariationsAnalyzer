@php
  if($errors->any()){
    $session = '<h3>Error!</h3><ul>';
      foreach ($errors->all() as $error){
        $session .= '<li>'. $error .'</li>';
      }
    $session .= '</ul>';
    Session::flash('danger', $session);
  }
  $notices = ['danger','success','warning','info'];
@endphp
@foreach($notices as $notice)
  @if(!empty(session($notice)))
  <div class="col-lg-8 col-xl-8 offset-lg-2 offset-xl-2" style="margin-top: 20px">
    <div class="alert alert-{{$notice}} alert-dismissible" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <p>{!! session($notice) !!}</p>
    </div>
  </div>
  @php
    session()->forget($notice);
  @endphp
  @endif
@endforeach