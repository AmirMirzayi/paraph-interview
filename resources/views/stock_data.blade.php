<html>
<body style="direction: rtl">
<a href="{{ url("/") }}">Home</a>
<a href="{{ url("data") }}">Data</a>
@foreach($data as $row)
    نماد سهم: {{ $row->name ?? "" }}
    نام سهم: {{ $row->title ?? "" }}
    <a href="{{ url("chart",$row->_id) }}" style="font-size: larger;">نمودار و جزئیات معاملات</a>
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
        @foreach($row->quota as $quota)
            <tr>
                <td>{{$quota['count'] ?? ''}}</td>
                <td>{{$quota['volume'] ?? ''}}</td>
                <td>{{$quota['value'] ?? ''}}</td>
                <td>{{$quota['yesterday'] ?? ''}}</td>
                <td>{{$quota['first'] ?? ''}}</td>
                <td>{{$quota['last_trade_amount'] ?? ''}}</td>
                <td>{{$quota['last_trade_change'] ?? ''}}</td>
                <td>{{$quota['last_trade_percent'] ?? ''}}</td>
                <td>{{$quota['closed_price'] ?? ''}}</td>
                <td>{{$quota['closed_change'] ?? ''}}</td>
                <td>{{$quota['closed_percent'] ?? ''}}</td>
                <td>{{$quota['lowest'] ?? ''}}</td>
                <td>{{$quota['highest'] ?? ''}}</td>
                <td>{{$quota['trade_date'] ?? ''}}</td>
            </tr>
        @endforeach
    </table>
@endforeach
</body>
</html>

