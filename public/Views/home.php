<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
</head>
<body>

<div class="flex flex-col ;">

    <div class="flex-initial bg-gray-100 --tw-bg-opacity: 1 ; m-4 ; rounded-lg ">
        <p class="text-2xl font-bold text-indigo-900 --tw-text-opacity: 1; m-4">
            Your budget <?php echo number_format($_SESSION['wallet']['budget'] / 100, 2) . ' USD'; ?></p>
    </div>


    <div class="flex-initial bg-gray-100 --tw-bg-opacity: 1 ; m-4 ; rounded-lg">
        <form method="post" action="/">
            <label class="text-1xl font-bold text-indigo-900 --tw-text-opacity: 1; m-4 "
                   for="symbol">Symbol </label>
            <input class="shadow appearance-none border rounded py-2 px-3 text-gray-700
    leading-tight focus:outline-none focus:shadow-outline; m-1"
                   type="text" name="symbol" id="symbol">

            <label class="text-1xl font-bold text-indigo-900 --tw-text-opacity: 1; m-4 "
                   for="amount">Amount </label>
            <input class="shadow appearance-none border rounded py-2 px-3 text-gray-700
    leading-tight focus:outline-none focus:shadow-outline; m-1"
                   type="text" name="amount" id="amount">
            <br>
            <button class="bg-indigo-400 hover:bg-indigo-500 text-white py-2 px-4 rounded border border-indigo-900 ; m-4"
                    type="submit">Get price
            </button>
        </form>

        <?php if (isset($_POST['symbol']) && isset($_POST['amount']) &&
            $_POST['symbol'] != '' && $_POST['amount'] != '') { ?>

            <p class="text-1xl text-pink-700 --tw-text-opacity: 1; m-2 ">
                <?php echo $_SESSION['stock']['amount'] . ' of ' . $_SESSION['stock']['symbol'] . ' for ' .
                    number_format(((int)($_SESSION['stock']['amount'] * $_SESSION['stock']['price'])) / 100, 2) .
                    ' USD'; ?></p>

            <form method="post" action="/buy">
                <button class="bg-pink-600 hover:bg-pink-800 text-white py-2 px-4 rounded border border-pink-900 ; m-4"
                        type="submit" name="buy"> Buy
                </button>
            </form>
        <?php } ?>
    </div>


    <div class="flex-initial flex-col bg-gray-100 --tw-bg-opacity: 1; m-4 ; rounded-lg ; flex justify-center ;">

        <div>
            <span class="text-2xl font-bold text-pink-700 --tw-text-opacity: 1; m-2 ">Purchases</span>
        </div>

        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg m-4">
            <table class="min-w-full divide-y divide-gray-200">
                <tr class="rounded-t-sm; bg-indigo-300 --tw-bg-opacity: 1; rounded-t-lg">
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Symbol
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Amount
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Purchased <br> one / all (USD)
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Date
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Current price <br> one / all (USD)
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        rise/fall
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Selling amount
                    </th>
                </tr>

                <?php foreach ($stockList as $key => $value) { ?>
                    <tr class=" text-indigo-900 text-base ">
                        <td class="px-6 py-4 whitespace-nowrap text-sm"><?php echo $value['stock']->getSymbol() ?></td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm"><?php echo $value['stock']->getAmount() ?></td>
                        <td class=" px-6 py-4 whitespace-nowrap text-sm">
                            <?php echo number_format($value['stock']->getPrice() / 100, 2) . ' / '
                                . number_format(($value['stock']->getAmount() * $value['stock']->getPrice()) / 100, 2) ?></td>

                        <td> <?php echo $value['stock']->getDate() ?> </td>

                        <td class=" px-6 py-4 whitespace-nowrap text-sm">
                            <?php echo number_format($value['currentPrice'] / 100, 2) . ' / ' .
                                number_format(($value['currentPrice'] * $value['stock']->getAmount()) / 100, 2); ?></td>

                        <?php if ($value['currentPrice'] - $value['stock']->getPrice() <= 0) { ?>
                            <td class=" px-6 py-4 whitespace-nowrap text-sm ; font-bold text-blue-600 ">
                                <?php echo '↓ ' .
                                    number_format(100 - ($value['stock']->getPrice() * 100 / $value['currentPrice']), 3) .
                                    '%'; ?></td>
                        <?php } else { ?>
                            <td class=" px-6 py-4 whitespace-nowrap text-sm ; font-bold text-red-500 ">
                                <?php echo '↑ ' .
                                    number_format(100 - ($value['stock']->getPrice() * 100 / $value['currentPrice']), 3) .
                                    '%'; ?></td>
                        <?php } ?>


                        <td class="px-6 py-4 whitespace-nowrap text-left text-sm font-medium ">
                            <form method="post" action="/sell">
                                <input class="shadow appearance-none border rounded py-2 px-3 text-gray-700
                                                     leading-tight focus:outline-none focus:shadow-outline; m-1"
                                       type="text" name="amountSold">
                                <button class="font-bold text-indigo-600 hover:text-indigo-900 m-2"
                                        type="submit" name="sell" value=<?php echo $key; ?>> Sell
                                </button>
                            </form>
                        </td>
                    </tr>

                <?php } ?>
            </table>
        </div>
    </div>


    <div class="flex-initial flex-col bg-gray-100 --tw-bg-opacity: 1; m-4 ; rounded-lg ; flex justify-center ;">

        <div>
            <span class="text-2xl font-bold text-pink-700 --tw-text-opacity: 1; m-2 ">Sells</span>
        </div>

        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg m-4">
            <table class="min-w-full divide-y divide-gray-200">
                <tr class="rounded-t-sm; bg-indigo-300 --tw-bg-opacity: 1; rounded-t-lg">
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Symbol
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Amount
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Purchase price (USD)
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Sold price <br> one/all (USD)
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        income (USD)
                    </th>
                </tr>

                <?php foreach ($soldStockList as $sold) { ?>
                    <tr class=" text-indigo-900 text-base ">
                        <td class="px-6 py-4 whitespace-nowrap text-sm"><?php echo $sold->getSymbol() ?></td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm"><?php echo $sold->getAmount() ?></td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                            <?php echo number_format($sold->getPurchasePrice() / 100, 2) ?></td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                            <?php echo number_format($sold->getSoldPrice() / 100, 2) . ' / '
                                . number_format(($sold->getAmount() * $sold->getSoldPrice()) / 100, 2) ?></td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                            <?php echo number_format($sold->getBenefit() / 100, 2) ?> </td>
                    </tr>

                <?php } ?>
            </table>
        </div>
    </div>


</div>


</body>
</html>
