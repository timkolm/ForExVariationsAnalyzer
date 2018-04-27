<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <!-- Styles -->
        
    </head>
    <body>
              @include('analyzer._notices')
        <div class="row">
          <div class="col-lg-8 col-xl-8 offset-lg-2 offset-xl-2 text-center">
            <div class="content">
              <div style="margin-top:250px">
                @if(!empty($table))
                <div style="margin-top:-250px">
                  <br>
                  <h1>Variation Chart</h1>
                  <table class="table table-sm">
                    <thead>
                    <tr>
                      <th>Currency</th>
                      <th>Date {{ $startDate->format('Y-m-d') }}</th>
                      <th>Date {{ $endDate->format('Y-m-d') }}</th>
                      <th>Rate Variation (%)</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($table as $currency => $row)
                    <tr>
                      <th>{{$currency}}</th>
                      <td>{{$row['start']}}</td>
                      <td>{{$row['end']}}</td>
                      <td>{{$row['difference']}}</td>
                    </tr>
                    @endforeach
                    </tbody>
                  </table>
                </div>
                @endif
              </div>
                <form action="{{ route('analyzator') }}" method="post"> 
                    <label>Enter a date</label>
                    {{ csrf_field() }}
                    <input type="text" name="date" placeholder="YYYY/MM/DD">
                    <button type="submit" class="btn btn-primary">Analyze</button>
                </form>
            <br><br><br>
            </div>
          </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  
    </body>
</html>
