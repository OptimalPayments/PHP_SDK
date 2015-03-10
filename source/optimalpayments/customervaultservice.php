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

class CustomerVaultService
{
    /**
	 * @var OptimalApiClient
	 */
    private $client;

    /**
	 * The uri for the customer vault api.
	 * @var string
	 */
    private $uri = "customervault/v1";

    /**
	 * Initialize the customer vault service.
	 *
	 * @param \OptimalPayments\OptimalApiClient $client
	 */
    public function __construct(OptimalApiClient $client)
    {
        $this->client = $client;
    }

    /**
	 * Monitor.
	 *
	 * @return bool true if successful
	 * @throws OptimalException
	 * @throws NetbanxException
	 */
    public function monitor()
    {
        $request = new Request(array(
             'method' => Request::GET,
             'uri' => 'customervault/monitor'
        ));

        $response = $this->client->processRequest($request);
        return ($response['status'] == 'READY');
    }

    /**
	 * Create profile.
	 *
	 * @param \OptimalPayments\CustomerVault\Profile $profile
	 * @return \OptimalPayments\CustomerVault\Profile
	 * @throws OptimalException
	 * @throws NetbanxException
	 */
    public function createProfile(CustomerVault\Profile $profile)
    {
        $profile->setRequiredFields(array(
             'merchantCustomerId',
             'locale'
        ));
        $profile->setOptionalFields(array(
             'firstName',
             'middleName',
             'lastName',
             'dateOfBirth',
             'ip',
             'gender',
             'nationality',
             'email',
             'phone',
             'cellPhone'
        ));

        $request = new Request(array(
             'method' => Request::POST,
             'uri' => $this->prepareURI("/profiles"),
             'body' => $profile
        ));
        $response = $this->client->processRequest($request);

        return new CustomerVault\Profile($response);
    }

    /**
	 * Update profile.
	 *
	 * @param \OptimalPayments\CustomerVault\Profile $profile
	 * @return \OptimalPayments\CustomerVault\Profile
	 * @throws OptimalException
	 * @throws NetbanxException
	 */
    public function updateProfile(CustomerVault\Profile $profile)
    {
        $profile->setRequiredFields(array('id'));
        $profile->checkRequiredFields();
        $profile->setRequiredFields(array(
             'merchantCustomerId',
             'locale'
        ));
        $profile->setOptionalFields(array(
             'firstName',
             'middleName',
             'lastName',
             'dateOfBirth',
             'ip',
             'gender',
             'nationality',
             'email',
             'phone',
             'cellPhone'
        ));

        $request = new Request(array(
             'method' => Request::PUT,
             'uri' => $this->prepareURI("/profiles/" . $profile->id),
             'body' => $profile
        ));
        $response = $this->client->processRequest($request);

        return new CustomerVault\Profile($response);
    }

    /**
	 * Delete profile.
	 *
	 * @param \OptimalPayments\CustomerVault\Profile $profile
	 * @return bool
	 * @throws OptimalException
	 * @throws NetbanxException
	 */
    public function deleteProfile(CustomerVault\Profile $profile)
    {
        $profile->setRequiredFields(array('id'));
        $profile->checkRequiredFields();

        $request = new Request(array(
             'method' => Request::DELETE,
             'uri' => $this->prepareURI("/profiles/" . $profile->id)
        ));
        $this->client->processRequest($request);

        return true;
    }

    /**
	 * Get the profile.
	 *
	 * @param \OptimalPayments\CustomerVault\Profile $profile
	 * @param bool $includeAddresses
	 * @param bool $includeCards
	 * @return bool
	 * @throws OptimalException
	 * @throws NetbanxException
	 */
    public function getProfile(CustomerVault\Profile $profile, $includeAddresses = false, $includeCards = false)
    {
        $profile->setRequiredFields(array('id'));
        $profile->checkRequiredFields();

        $fields = array();
        if($includeAddresses) {
            $fields[] = 'addresses';
        }
        if($includeCards) {
            $fields[] = 'cards';
        }

        $queryStr = array();
        if($fields) {
            $queryStr['fields'] = join(',', $fields);
        }

        $request = new Request(array(
             'method' => Request::GET,
             'uri' => $this->prepareURI("/profiles/" . $profile->id),
             'queryStr' => $queryStr
        ));
        $response = $this->client->processRequest($request);

        return new CustomerVault\Profile($response);
    }

    /**
	 * Create address.
	 *
	 * @param \OptimalPayments\CustomerVault\Address $address
	 * @return \OptimalPayments\CustomerVault\Address
	 * @throws OptimalException
	 * @throws NetbanxException
	 */
    public function createAddress(CustomerVault\Address $address)
    {
        $address->setRequiredFields(array('profileID'));
        $address->checkRequiredFields();
        $address->setRequiredFields(array('country'));
        $address->setOptionalFields(array(
             'nickName',
             'street',
             'street2',
             'city',
             'state',
             'zip',
             'recipientName',
             'phone',
        ));

        $request = new Request(array(
             'method' => Request::POST,
             'uri' => $this->prepareURI("/profiles/" . $address->profileID . "/addresses"),
             'body' => $address
        ));
        $response = $this->client->processRequest($request);
        $response['profileID'] = $address->profileID;

        return new CustomerVault\Address($response);
    }

    /**
	 * Update address.
	 *
	 * @param \OptimalPayments\CustomerVault\Address $address
	 * @return \OptimalPayments\CustomerVault\Address
	 * @throws OptimalException
	 * @throws NetbanxException
	 */
    public function updateAddress(CustomerVault\Address $address)
    {
        $address->setRequiredFields(array(
             'profileID',
             'id'
        ));
        $address->checkRequiredFields();
        $address->setRequiredFields(array('country'));
        $address->setOptionalFields(array(
             'nickName',
             'street',
             'street2',
             'city',
             'state',
             'zip',
             'recipientName',
             'phone',
        ));

        $request = new Request(array(
             'method' => Request::PUT,
             'uri' => $this->prepareURI("/profiles/" . $address->profileID . "/addresses/" . $address->id),
             'body' => $address
        ));
        $response = $this->client->processRequest($request);
        $response['profileID'] = $address->profileID;

        return new CustomerVault\Address($response);
    }

    /**
	 * Delete address.
	 *
	 * @param \OptimalPayments\CustomerVault\Address $address
	 * @return bool
	 * @throws OptimalException
	 * @throws NetbanxException
	 */
    public function deleteAddress(CustomerVault\Address $address)
    {
        $address->setRequiredFields(array(
             'profileID',
             'id'
        ));
        $address->checkRequiredFields();

        $request = new Request(array(
             'method' => Request::DELETE,
             'uri' => $this->prepareURI("/profiles/" . $address->profileID . "/addresses/" . $address->id),
        ));
        $this->client->processRequest($request);

        return true;
    }

    /**
	 * Get the address.
	 *
	 * @param \OptimalPayments\CustomerVault\Address $address
	 * @return bool
	 * @throws OptimalException
	 * @throws NetbanxException
	 */
    public function getAddress(CustomerVault\Address $address)
    {
        $address->setRequiredFields(array(
             'profileID',
             'id'
        ));
        $address->checkRequiredFields();

        $request = new Request(array(
             'method' => Request::GET,
             'uri' => $this->prepareURI("/profiles/" . $address->profileID . "/addresses/" . $address->id),
        ));
        $response = $this->client->processRequest($request);
        $response['profileID'] = $address->profileID;

        return new CustomerVault\Address($response);
    }

    /**
	 * Create card.
	 *
	 * @param \OptimalPayments\CustomerVault\Card $card
	 * @return \OptimalPayments\CustomerVault\Card
	 * @throws OptimalException
	 * @throws NetbanxException
	 */
    public function createCard(CustomerVault\Card $card)
    {
        $card->setRequiredFields(array('profileID'));
        $card->checkRequiredFields();
        $card->setRequiredFields(array(
             'cardNum',
             'cardExpiry'
        ));
        $card->setOptionalFields(array(
             'nickName',
             'merchantRefNum',
             'holderName',
             'billingAddressId',
        ));

        $request = new Request(array(
             'method' => Request::POST,
             'uri' => $this->prepareURI("/profiles/" . $card->profileID . "/cards"),
             'body' => $card
        ));
        $response = $this->client->processRequest($request);
        $response['profileID'] = $card->profileID;

        return new CustomerVault\Card($response);
    }

    /**
	 * Update card.
	 *
	 * @param \OptimalPayments\CustomerVault\Card $card
	 * @return \OptimalPayments\CustomerVault\Card
	 * @throws OptimalException
	 * @throws NetbanxException
	 */
    public function updateCard(CustomerVault\Card $card)
    {
        $card->setRequiredFields(array(
             'profileID',
             'id'
        ));
        $card->checkRequiredFields();
        $card->setRequiredFields(array());
        $card->setOptionalFields(array(
             'cardExpiry',
             'nickName',
             'merchantRefNum',
             'holderName',
             'billingAddressId',
        ));

        $request = new Request(array(
             'method' => Request::PUT,
             'uri' => $this->prepareURI("/profiles/" . $card->profileID . "/cards/" . $card->id),
             'body' => $card
        ));
        $response = $this->client->processRequest($request);
        $response['profileID'] = $card->profileID;

        return new CustomerVault\Card($response);
    }

    /**
	 * Delete card.
	 *
	 * @param \OptimalPayments\CustomerVault\Card $card
	 * @return bool
	 * @throws OptimalException
	 * @throws NetbanxException
	 */
    public function deleteCard(CustomerVault\Card $card)
    {
        $card->setRequiredFields(array(
             'profileID',
             'id'
        ));
        $card->checkRequiredFields();

        $request = new Request(array(
             'method' => Request::DELETE,
             'uri' => $this->prepareURI("/profiles/" . $card->profileID . "/cards/" . $card->id),
        ));
        $this->client->processRequest($request);

        return true;
    }

    /**
	 * Get the card.
	 *
	 * @param \OptimalPayments\CustomerVault\Card $card
	 * @return bool
	 * @throws OptimalException
	 * @throws NetbanxException
	 */
    public function getCard(CustomerVault\Card $card)
    {
        $card->setRequiredFields(array(
             'profileID',
             'id'
        ));
        $card->checkRequiredFields();

        $request = new Request(array(
             'method' => Request::GET,
             'uri' => $this->prepareURI("/profiles/" . $card->profileID . "/cards/" . $card->id),
        ));
        $response = $this->client->processRequest($request);
        $response['profileID'] = $card->profileID;

        return new CustomerVault\Card($response);
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
