<?php
    $blockId = 'revenue_card_' . \App\Helper::getRandomInt();

$daylyTransactionsSum = 1;
$weeklyTransactionsSum = 2;
$monthlyTransactionsSum = 3;
?>
<div class="col-xxl-4 col-md-6" id="{!! $blockId !!}">
    <div class="card info-card sales-card">

        <div class="filter">
            <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                <li class="dropdown-header text-start">
                    <h6>Фильтр</h6>
                </li>

                <li><span class="dropdown-item" data-target="{!! $blockId !!}_filter_1">Сегодня</span></li>
                <li><span class="dropdown-item" data-target="{!! $blockId !!}_filter_2">7 дней</span></li>
                <li><span class="dropdown-item" data-target="{!! $blockId !!}_filter_3">30 дней</span></li>
            </ul>
        </div>

        <div class="card-body" data-target="{!! $blockId !!}_filter_1">
            <h5 class="card-title">Выручка <span>| сегодня</span></h5>

            <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    {{--                    <i class="bi bi-currency-dollar"></i>--}}
                    <i class="bx bx-ruble"></i>
                </div>
                <div class="ps-3">
                    <h6>{!! $daylyTransactionsSum !!} руб.</h6>
                    {{--                    <span class="text-success small pt-1 fw-bold">12%</span>--}}
                    {{--                    <span class="text-muted small pt-2 ps-1">increase</span>--}}
                </div>
            </div>
        </div>

        <div class="card-body hidden" data-target="{!! $blockId !!}_filter_2">
            <h5 class="card-title">Выручка <span>| неделя</span></h5>

            <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bx bx-ruble"></i>
                </div>
                <div class="ps-3">
                    <h6>{!! $weeklyTransactionsSum !!} руб.</h6>
                    {{--                    <span class="text-success small pt-1 fw-bold">12%</span>--}}
                    {{--                    <span class="text-muted small pt-2 ps-1">increase</span>--}}
                </div>
            </div>
        </div>

        <div class="card-body hidden" data-target="{!! $blockId !!}_filter_3">
            <h5 class="card-title">Выручка <span>| месяц</span></h5>

            <div class="d-flex align-items-center">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bx bx-ruble"></i>
                </div>
                <div class="ps-3">
                    <h6>{!! $monthlyTransactionsSum !!} руб.</h6>
                    {{--                    <span class="text-success small pt-1 fw-bold">12%</span>--}}
                    {{--                    <span class="text-muted small pt-2 ps-1">increase</span>--}}
                </div>
            </div>
        </div>

    </div>
</div>

<script>
    document.querySelectorAll('#{!! $blockId !!} .filter li .dropdown-item[data-target]').forEach(function(el) {
        el.addEventListener('click', function(e) {
            let dataTarget = el.getAttribute('data-target');
            document.querySelectorAll('#{!! $blockId !!} .card-body').forEach(function(card) {
                if (card.getAttribute('data-target') === dataTarget) {
                    card.classList.remove('hidden');
                } else {
                    card.classList.add('hidden');
                }
            });
        });
    });
</script>
