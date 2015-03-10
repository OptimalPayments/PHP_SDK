<?php
/*
 * Copyright (c) 2014 Optimal Payments
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy of this software and
 * associated documentation files (the "Software"), to deal in the Software without restriction,
 * including without limitation the rights to use, copy, modify, merge, publish, distribute,
 * sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all copies or
 * substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT
 * NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND
 * NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM,
 * DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 */

namespace OptimalPayments;

class HostedPaymentService
{
    /**
	 * @var OptimalApiClient
	 */
    private $client;

    /**
	 * The uri for the hosted payment api.
	 * @var string
	 */
    private $uri = "hosted/v1";

    /**
	 * Initialize the hosted payment service.
	 *
	 * @param \OptimalPayments\OptimalApiClient $client
	 */
    public function __construct(OptimalApiClient $client)
    {
        $this->client = $client;
    }

    /**
	 * Process order.
	 *
	 * @param \OptimalPayments\HostedPayment\Order $order
	 * @return \OptimalPayments\HostedPayment\Order
	 * @throws OptimalException
	 * @throws NetbanxException
	 */
    public function processOrder(HostedPayment\Order $order)
    {
        $order->setRequiredFields(array(
             'merchantRefNum',
             'currencyCode',
             'totalAmount'
        ));
        $order->setOptionalFields(array(
             'customerIp',
             'customerNotificationEmail',
             'merchantNotificationEmail',
             'dueDate',
             'profile',
             'shoppingCart',
             'ancillaryFees',
             'billingDetails',
             'shippingDetails',
             'callback',
             'redirect',
             'link',
             'paymentMethod',
             'addendumData',
             'locale',
             'extendedOptions',
        ));

        $request = new Request(array(
             'method' => Request::POST,
             'uri' => $this->prepareURI("/orders"),
             'body' => $order
        ));
        $response = $this->client->processRequest($request);

        return new HostedPayment\Order($response);
    }

    /**
	 * Get the order.
	 *
	 * @param \OptimalPayments\HostedPayment\Order $order
	 * @return \OptimalPayments\HostedPayment\Order
	 * @throws OptimalException
	 * @throws NetbanxException
	 */
    public function getOrder(HostedPayment\Order $order)
    {
        $order->setRequiredFields(array('id'));
        $order->checkRequiredFields();

        $request = new Request(array(
             'uri' => $this->prepareURI("/orders/" . $order->id)
        ));

        $response = $this->client->processRequest($request);

        return new HostedPayment\Order($response);
    }

    /**
	 * Cancel order.
	 *
	 * @param \OptimalPayments\HostedPayment\Order $order
	 * @return \OptimalPayments\HostedPayment\Order
	 * @throws OptimalException
	 * @throws NetbanxException
	 */
    public function cancelOrder(HostedPayment\Order $order)
    {
        $order->setRequiredFields(array('id'));
        $order->checkRequiredFields();

        $request = new Request(array(
             'method' => Request::DELETE,
             'uri' => $this->prepareURI("/orders/" . $order->id)
        ));

        $response = $this->client->processRequest($request);

        return new HostedPayment\Order($response);
    }

    /**
	 * Cancel held order.
	 *
	 * @param \OptimalPayments\HostedPayment\Order $order
	 * @return \OptimalPayments\HostedPayment\Order
	 * @throws OptimalException
	 * @throws NetbanxException
	 */
    public function cancelHeldOrder(HostedPayment\Order $order)
    {
        $order->setRequiredFields(array('id'));
        $order->checkRequiredFields();

        $tmpOrder = new HostedPayment\Order(array(
             'transaction' => array(
                  'status' => 'cancelled'
             )
        ));

        $request = new Request(array(
             'method' => Request::PUT,
             'uri' => $this->prepareURI("/orders/" . $order->id),
             'body' => $tmpOrder
        ));

        $response = $this->client->processRequest($request);

        return new HostedPayment\Order($response);
    }

    /**
	 * Approve held order.
	 *
	 * @param \OptimalPayments\HostedPayment\Order $order
	 * @return \OptimalPayments\HostedPayment\Order
	 * @throws OptimalException
	 * @throws NetbanxException
	 */
    public function approveHeldOrder(HostedPayment\Order $order)
    {
        $order->setRequiredFields(array('id'));
        $order->checkRequiredFields();

        $tmpOrder = new HostedPayment\Order(array(
             'transaction' => array(
                  'status' => 'success'
             )
        ));

        $request = new Request(array(
             'method' => Request::PUT,
             'uri' => $this->prepareURI("/orders/" . $order->id),
             'body' => $tmpOrder
        ));

        $response = $this->client->processRequest($request);

        return new HostedPayment\Order($response);
    }

    /**
	 * Resend order callback.
	 *
	 * @param \OptimalPayments\HostedPayment\Order $order
	 * @return True if successful
	 * @throws OptimalException
	 * @throws NetbanxException
	 */
    public function resendCallback(HostedPayment\Order $order)
    {
        $order->setRequiredFields(array('id'));
        $order->checkRequiredFields();

        $request = new Request(array(
             'method' => Request::GET,
             'uri' => $this->prepareURI("/orders/" . $order->id . "/resend_callback")
        ));

        $this->client->processRequest($request);

        return true;
    }

    /**
	 * Refund.
	 *
	 * @param \OptimalPayments\HostedPayment\Refund $refund
	 * @return \OptimalPayments\HostedPayment\Refund
	 * @throws OptimalException
	 * @throws NetbanxException
	 */
    public function refund(HostedPayment\Refund $refund)
    {
        $refund->setRequiredFields(array('orderID'));
        $refund->checkRequiredFields();
        $refund->setRequiredFields(array());
        $refund->setOptionalFields(array(
             'amount',
             'merchantRefNum'
        ));

        $request = new Request(array(
             'method' => Request::POST,
             'uri' => $this->prepareURI("/orders/" . $refund->orderID . '/refund'),
             'body' => $refund
        ));

        $response = $this->client->processRequest($request);

        return new HostedPayment\Refund($response);
    }

    /**
	 * Settlement.
	 *
	 * @param \OptimalPayments\HostedPayment\Settlement $settlement
	 * @return \OptimalPayments\HostedPayment\Settlement
	 * @throws OptimalException
	 * @throws NetbanxException
	 */
    public function settlement(HostedPayment\Settlement $settlement)
    {
        $settlement->setRequiredFields(array('orderID'));
        $settlement->checkRequiredFields();
        $settlement->setRequiredFields(array());
        $settlement->setOptionalFields(array(
             'amount',
             'merchantRefNum'
        ));

        $request = new Request(array(
             'method' => Request::POST,
             'uri' => $this->prepareURI("/orders/" . $settlement->orderID . '/settlement'),
             'body' => $settlement
        ));

        $response = $this->client->processRequest($request);

        return new HostedPayment\Settlement($response);
    }

    /**
	 * Rebill order.
	 *
	 * @param \OptimalPayments\HostedPayment\Order $order
	 * @return \OptimalPayments\HostedPayment\Order
	 * @throws OptimalException
	 * @throws NetbanxException
	 */
    public function rebillOrder(HostedPayment\Order $order)
    {
        if (!isset($order->id)) {
            if (!isset($order->profile)) {
                throw new OptimalException('You must specify a profile or id', 500);
            } elseif (!isset($order->profile->id) || !isset($order->profile->paymentToken)) {
                throw new OptimalException('You must specify a profile.id and profile.paymentToken');
            }
        }
        $order->setRequiredFields(array(
             'merchantRefNum',
             'currencyCode',
             'totalAmount'
        ));
        $order->setOptionalFields(array(
             'customerIp',
             'customerNotificationEmail',
             'merchantNotificationEmail',
             'dueDate',
             'profile',
             'shoppingCart',
             'ancillaryFees',
             'billingDetails',
             'shippingDetails',
             'callback',
             'paymentMethod',
             'addendumData',
             'locale',
             'extendedOptions',
        ));

        $request = new Request(array(
             'method' => Request::POST,
             'uri' => $this->prepareURI("/orders" . (isset($order->id) ? "/" . $order->id : "")),
             'body' => $order
        ));
        $response = $this->client->processRequest($request);

        return new HostedPayment\Order($response);
    }

    /**
	 * Update rebill.
	 *
	 * @param \OptimalPayments\HostedPayment\Order $order
	 * @return \OptimalPayments\HostedPayment\Order
	 * @throws OptimalException
	 * @throws NetbanxException
	 */
    public function updateRebill(HostedPayment\Order $order)
    {
        $order->setRequiredFields(array(
             'id'
        ));
        $order->checkRequiredFields();
        $order->setRequiredFields(array());
        $order->setOptionalFields(array(
             'merchantRefNum',
             'currencyCode',
             'totalAmount',
             'customerIp',
             'customerNotificationEmail',
             'merchantNotificationEmail',
             'dueDate',
             'profile',
             'shoppingCart',
             'ancillaryFees',
             'billingDetails',
             'shippingDetails',
             'callback',
             'paymentMethod',
             'addendumData',
             'locale',
             'extendedOptions',
        ));

        $request = new Request(array(
             'method' => Request::PUT,
             'uri' => $this->prepareURI("/orders/" . $order->id),
             'body' => $order
        ));
        $response = $this->client->processRequest($request);

        return new HostedPayment\Order($response);
    }

    /**
	 * Get matching orders
	 *
	 * @param int $count
	 * @return HostedPayment\Order[]
	 * @throws OptimalException
	 * @throws NetbanxException
	 */
    public function getOrders($count = 0)
    {
        $queryStr = array();
        if (!is_int($count) || $count < 0) {
            throw new OptimalException("Invalid count $count. Positive integer expected.");
        }
        if ($count) {
            $queryStr['num'] = $count;
        }
        $request = new Request(array(
             'method' => Request::GET,
             'uri' => $this->prepareURI("/orders"),
             'queryStr' => $queryStr
        ));

        $response = $this->client->processRequest($request);

        return new HostedPayment\Pagerator($this->client, $response, '\OptimalPayments\HostedPayment\Order');
    }

    /**
	 * Prepare the uri for submission to the api.
	 *
	 * @param type $path
	 * @return string uri
	 * @throw OptimalException
	 */
    private function prepareURI($path)
    {
        return $this->uri . $path;
    }

}
