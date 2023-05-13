<!DOCTYPE html>
<html lang="fa">
<a href="{{ url("/") }}">Home</a>
<a href="{{ url("data") }}">Data</a>
    <body style="direction: rtl">
    @if ($errors->any())
        <div class="alert alert-danger" style="color: darkred">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ url("update") }}" method="post">
        @csrf
        <input name="id" value="{{ $data['id'] }}" type="hidden">
        <input type="hidden" value="{{$data['old_count'] ?? ""}}" name="old_count">
        <input type="hidden" value="{{$data['old_volume'] ?? ""}}" name="old_volume">
        <input type="hidden" value="{{$data['old_value'] ?? ""}}" name="old_value">
        <input type="hidden" value="{{$data['old_yesterday'] ?? ""}}" name="old_yesterday">
        <input type="hidden" value="{{$data['old_first'] ?? ""}}" name="old_first">
        <input type="hidden" value="{{$data['old_last_trade_amount'] ?? ""}}" name="old_last_trade_amount">
        <input type="hidden" value="{{$data['old_last_trade_change'] ?? ""}}" name="old_last_trade_change">
        <input type="hidden" value="{{$data['old_last_trade_percent'] ?? ""}}" name="old_last_trade_percent">
        <input type="hidden" value="{{$data['old_closed_price'] ?? ""}}" name="old_closed_price">
        <input type="hidden" value="{{$data['old_closed_change'] ?? ""}}" name="old_closed_change">
        <input type="hidden" value="{{$data['old_closed_percent'] ?? ""}}" name="old_closed_percent">
        <input type="hidden" value="{{$data['old_lowest'] ?? ""}}" name="old_lowest">
        <input type="hidden" value="{{$data['old_highest'] ?? ""}}" name="old_highest">
        <input name="old_date" value="{{ $data['date'] }}" type="hidden">
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
                <input type="text" name="last_trade_change" class="form-control" style="direction: ltr; border: 1px deepskyblue solid; margin: 5px 5px; padding: 5px 5px; border-radius: 5px;" value="21.00">
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
    </body>
</html>
