<div wire:poll.1s>
    <div class='pt-3'>
        @php
            $pricebtc = (string) ((int) $prices['BTC']);
            $decimalbtc = (string) (((int) ($prices['BTC'] * 100)) % 100);

            while (strlen($decimalbtc) < 2) {
                $decimalbtc = '0' . $decimalbtc;
            }

            $priceeth = (string) ((int) $prices['ETH']);
            $decimaleth = (string) (((int) ($prices['ETH'] * 100)) % 100);

            while (strlen($decimaleth) < 2) {
                $decimaleth = '0' . $decimaleth;
            }

        @endphp
        <p class='text-xl'>Bitcoin: ${{ $pricebtc }}.{{ $decimalbtc }}</p>
        <p class='text-xl'>Ethereum: ${{ $priceeth }}.{{ $decimaleth }}</p>
    </div>
</div>
