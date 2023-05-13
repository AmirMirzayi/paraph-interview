<html>
<a href="{{ url("/") }}">Home</a>
<a href="{{ url("data") }}">Data</a>
<body style="direction: rtl">
نماد سهم: {{$data->name}} -
نام سهم: {{$data->title}}

<div>
    <canvas id="myChart"></canvas>
</div>

<script src="{{ asset("js/chart.js") }}"></script>
<script>
  const ctx = document.getElementById('myChart');

  new Chart(ctx, {
    type: 'bar',
    data: {
      labels: [
      @foreach($data->quota as $quota)
        '{{ $quota['trade_date'] ?? '' }}',
      @endforeach
      ],
      datasets: [{
        label: 'نمودار تغییر ارزش سهام',
        data: [
            @foreach($data->quota as $quota)
        [{{ $quota['lowest'] ?? '' }},{{ $quota['highest'] ?? '' }}],
      @endforeach
        ],
        borderRadius: 10,
        borderWidth: 2,
        fill: false,
        borderColor: 'rgb(75, 50, 192)',
        tension: 0.1
      }]
    },
    options: {
    responsive: true,
    plugins: {
      legend: {
        position: 'top',
      },
      title: {
        display: true,
        text: 'Chart.js Floating Bar Chart'
      }
    },
      scales: {
        y: {
          beginAtZero: false
        }
      }
    }
  });
</script>
</hr>
<div style="margin: 30px 0px;">
    @if ($errors->any())
        <div class="alert alert-danger" style="color: darkred">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if(Session::has('success'))
        <div style="color: white; text-align: center; background: green; padding: 5px;">
            {{ Session::get('success') }}
            @php
                Session::forget('success');
            @endphp
        </div>
    @endif
    <h3> ثبت دستی اطلاعات</h3>
    <form action="{{ url("manual") }}" method="post">
        @csrf
        <input name="id" value="{{ $data->_id }}" type="hidden">
        <div>
        <div style="display: inline-block">
            <label for="count">تعداد</label>
            <input type="number" name="count" class="form-control" style="direction: ltr; border: 1px deepskyblue solid; margin: 5px 5px; padding: 5px 5px; border-radius: 5px;" value="26091">
        </div>
        <div style="display: inline-block">
            <label for="volume">حجم</label>
            <input type="number" name="volume" class="form-control" style="direction: ltr; border: 1px deepskyblue solid; margin: 5px 5px; padding: 5px 5px; border-radius: 5px;" value="1216916657">
        </div>
        <div style="display: inline-block">
            <label for="value">ارزش</label>
            <input type="number" name="value" class="form-control" style="direction: ltr; border: 1px deepskyblue solid; margin: 5px 5px; padding: 5px 5px; border-radius: 5px;" value="3010253476291">
        </div>
        <div style="display: inline-block">
            <label for="yesterday">دیروز</label>
            <input type="number" name="yesterday" class="form-control" style="direction: ltr; border: 1px deepskyblue solid; margin: 5px 5px; padding: 5px 5px; border-radius: 5px;" value="2398">
        </div>
        </div>
        <div>
        <div style="display: inline-block">
            <label for="first">اولین</label>
            <input type="number" name="first" class="form-control" style="direction: ltr; border: 1px deepskyblue solid; margin: 5px 5px; padding: 5px 5px; border-radius: 5px;" value="2517">
        </div>
        <div style="display: inline-block">
            <label for="last_trade_amount">آخرین معامله - مقدار</label>
            <input type="number" name="last_trade_amount" class="form-control" style="direction: ltr; border: 1px deepskyblue solid; margin: 5px 5px; padding: 5px 5px; border-radius: 5px;" value="2419">
        </div>
        <div style="display: inline-block">
            <label for="last_trade_change">آخرین معامله - تغییر</label>
            <input type="number" name="last_trade_change" class="form-control" style="direction: ltr; border: 1px deepskyblue solid; margin: 5px 5px; padding: 5px 5px; border-radius: 5px;" value="21.00">
        </div>
        </div>
        <div>
        <div style="display: inline-block">
            <label for="last_trade_percent">آخرین معامله - درصد</label>
            <input type="text" name="last_trade_percent" class="form-control" style="direction: ltr; border: 1px deepskyblue solid; margin: 5px 5px; padding: 5px 5px; border-radius: 5px;" value="0.88">
        </div>
        <div style="display: inline-block">
            <label for="closed_price">قیمت پایانی - مقدار</label>
            <input type="number" name="closed_price" class="form-control" style="direction: ltr; border: 1px deepskyblue solid; margin: 5px 5px; padding: 5px 5px; border-radius: 5px;" value="2474">
        </div>
        <div style="display: inline-block">
            <label for="closed_change">قیمت پایانی - تغییر</label>
            <input type="text" name="closed_change" class="form-control" style="direction: ltr; border: 1px deepskyblue solid; margin: 5px 5px; padding: 5px 5px; border-radius: 5px;" value="76.00">
        </div>
        </div>
        <div>
        <div style="display: inline-block">
            <label for="closed_percent">قیمت پایانی - درصد</label>
            <input type="text" name="closed_percent" class="form-control" style="direction: ltr; border: 1px deepskyblue solid; margin: 5px 5px; padding: 5px 5px; border-radius: 5px;" value="3.17">
        </div>
        <div style="display: inline-block">
            <label for="lowest">کمترین</label>
            <input type="number" name="lowest" class="form-control" style="direction: ltr; border: 1px deepskyblue solid; margin: 5px 5px; padding: 5px 5px; border-radius: 5px;" value="2400">
        </div>
        <div style="display: inline-block">
            <label for="highest">بیشترین</label>
            <input type="number" name="highest" class="form-control" style="direction: ltr; border: 1px deepskyblue solid; margin: 5px 5px; padding: 5px 5px; border-radius: 5px;" value="2517">
        </div>
        <div style="display: inline-block">
            <label for="trade_date">تاریخ</label>
            <input type="text" name="trade_date" class="form-control" style="direction: ltr; border: 1px deepskyblue solid; margin: 5px 5px; padding: 5px 5px; border-radius: 5px;" value="1401/02/22">
        </div>
        </div>
        <button type="submit" class="btn btn-primary" style="background: skyblue; padding: 5px 15px; border-radius: 20%; margin: 4px 20px;">تایید</button>
    </form>

    <div>
        <table>
            <tr>
                <th>تعداد</th>
                <th>حجم</th>
                <th>ارزش</th>
                <th>دیروز</th>
                <th>اولین</th>
                <th>آخرین معامله - مقدار</th>
                <th>آخرین معامله - تغییر</th>
                <th>آخرین معامله - درصد</th>
                <th>قیمت پایانی - مقدار</th>
                <th>قیمت پایانی - تغییر</th>
                <th>قیمت پایانی - درصد</th>
                <th>کمترین</th>
                <th>بیشترین</th>
                <th>تاریخ</th>
            </tr>
            @foreach($data->quota as $quota)
                <tr>
                    <td>{{$quota['count'] ?? ""}}</td>
                    <td>{{$quota['volume'] ?? ""}}</td>
                    <td>{{$quota['value'] ?? ""}}</td>
                    <td>{{$quota['yesterday'] ?? ""}}</td>
                    <td>{{$quota['first'] ?? ""}}</td>
                    <td>{{$quota['last_trade_amount'] ?? ""}}</td>
                    <td>{{$quota['last_trade_change'] ?? ""}}</td>
                    <td>{{$quota['last_trade_percent'] ?? ""}}</td>
                    <td>{{$quota['closed_price'] ?? ""}}</td>
                    <td>{{$quota['closed_change'] ?? ""}}</td>
                    <td>{{$quota['closed_percent'] ?? ""}}</td>
                    <td>{{$quota['lowest'] ?? ""}}</td>
                    <td>{{$quota['highest'] ?? ""}}</td>
                    <td>{{$quota['trade_date'] ?? ""}}</td>
                    <td>
                        <form action="{{ url("trash") }}" method="post">
                            @csrf
                            <input type="hidden" value="{{ $data->_id }}" name="id">
                            <input type="hidden" value="{{$quota['count'] ?? ""}}" name="old_count">
                            <input type="hidden" value="{{$quota['volume'] ?? ""}}" name="old_volume">
                            <input type="hidden" value="{{$quota['value'] ?? ""}}" name="old_value">
                            <input type="hidden" value="{{$quota['yesterday'] ?? ""}}" name="old_yesterday">
                            <input type="hidden" value="{{$quota['first'] ?? ""}}" name="old_first">
                            <input type="hidden" value="{{$quota['last_trade_amount'] ?? ""}}" name="old_last_trade_amount">
                            <input type="hidden" value="{{$quota['last_trade_change'] ?? ""}}" name="old_last_trade_change">
                            <input type="hidden" value="{{$quota['last_trade_percent'] ?? ""}}" name="old_last_trade_percent">
                            <input type="hidden" value="{{$quota['closed_price'] ?? ""}}" name="old_closed_price">
                            <input type="hidden" value="{{$quota['closed_change'] ?? ""}}" name="old_closed_change">
                            <input type="hidden" value="{{$quota['closed_percent'] ?? ""}}" name="old_closed_percent">
                            <input type="hidden" value="{{$quota['lowest'] ?? ""}}" name="old_lowest">
                            <input type="hidden" value="{{$quota['highest'] ?? ""}}" name="old_highest">
                            <input type="hidden" value="{{ $quota['trade_date'] ?? "" }}" name="date">
                            <button type="submit" class="btn btn-primary" style="background: indianred; padding: 5px 15px; border-radius: 10%; margin: 4px 10px; border-width: 0px;">حذف</button>
                        </form>
                    </td>
                    <td>
                        <form action="{{ url("edit") }}" method="get">
                            <input type="hidden" value="{{ $data->_id }}" name="id">
                            <input type="hidden" value="{{ $quota['trade_date'] ?? "" }}" name="date">
                            <button type="submit" class="btn btn-primary" style="background: orange; padding: 5px 15px; border-radius: 10%; margin: 4px 10px; border-width: 0px;">ویرایش</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
</div>
</body>
</html>
