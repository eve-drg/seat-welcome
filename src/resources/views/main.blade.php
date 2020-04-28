@extends('web::layouts.grids.8-4')

@section('title', 'Добро пожаловать! Правила Альянса')
@section('page_header', __('Добро пожаловать! Правила Альянса'))

@section('left')
    <div class="row">
        <div class="col-md-12 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-aqua"><i class="fa fa-bug"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Номер вашего телефона для экстренной связи</span>
                    @if ($tel === null)
                        <form action="{{route('welcome.bindtel')}}" role="form" method="post">
                            {{csrf_field()}}
                            <label for="killMailUrl" class="control-label">Вы не ввели номер телефона. Введите в формате +7CCCZZZYYXX
                                <input type="text" class="form-control" id="tel" name="tel" required />
                            </label>
                            <input type="submit" class="btn" value="Binding">
                        </form>
                    @else
                        <span class="info-box-number" id="tel">{{$tel}}</span>
                    @endif
                </div>
            </div>
            @if ($language !== 'en')
                <div class="info-box">
                    <span class="info-box-icon bg-maroon"><i class="fa fa-bomb"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Switch language</span>
                        <form action="{{route('welcome.switch-lang')}}" role="form" method="post">
                            {{csrf_field()}}
                            <input type="hidden" name="lang" value="en">
                            <input type="submit" class="btn" value="Switch">
                        </form>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection

@push('javascript')
    <script type="application/javascript">
        $(function () {
            $('#tel').on('click', function () {
                let td = $(this);
                let tel = td.text();
                let input = $("<input type='text' value='"+ tel + "' />");
                td.html(input);
                input.click(function () {
                    return false;
                });
                input.trigger("focus");
                input.blur(function () {
                    let newTel = this.value;
                    if (newTel !== tel) {
                        td.html(newTel);
                        $.ajax({
                            url: '{{route('welcome.bindtel')}}',
                            dataType: 'json',
                            method: 'POST',
                            data: {
                                'tel': newTel,
                                'isAjax': 1
                            },
                        }).fail(function (response) {
                            if (response.status !== 200) {
                                alert('Submission Failed');
                            }
                        });
                    } else {
                        td.html(tel);
                    }
                });
            });
        });
    </script>
@endpush