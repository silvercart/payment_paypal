<?php
/**
 * Copyright 2010, 2011 pixeltricks GmbH
 *
 * This file is part of SilverCart.
 *
 * SilverCart is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * SilverCart is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public License
 * along with SilverCart.  If not, see <http://www.gnu.org/licenses/>.
 *
 * @package Silvercart
 * @subpackage Forms Checkout
 */

/**
 * CheckoutProcessPaymentBeforeOrder
 *
 * @package Silvercart
 * @subpackage Forms Checkout
 * @author Sascha Koehler <skoehler@pixeltricks.de>
 * @copyright Pixeltricks GmbH
 * @since 06.04.2011
 * @license http://www.gnu.org/licenses/lgpl.html GNU Lesser General Public License
 */
class SilvercartPaymentPaypalCheckoutFormStep1 extends SilvercartCheckoutFormStepPaymentInit {

    /**
     * Here we set some preferences.
     *
     * @return void
     *
     * @author Sascha Koehler <skoehler@pixeltricks.de>
     * @copyright 2011 pixeltricks GmbH
     * @since 07.04.2011
     */
    public function preferences() {
        parent::preferences();

        $this->preferences['stepTitle']     = _t('SilvercartPaymentPaypal.ENTERDATAATPAYPAL');
        $this->preferences['stepIsVisible'] = true;
    }

    /**
     * Process the current step
     *
     * @return void
     *
     * @author Sascha Koehler <skoehler@pixeltricks.de>, Sebastian Diel <sdiel@pixeltricks.de>
     * @since 05.02.2013
     */
    public function process() {
        if (parent::process()) {
            $member         = Member::currentUser();
            $checkoutData   = $this->controller->getCombinedStepData();

            $this->paymentMethodObj->setCancelLink(Director::absoluteURL($this->controller->Link()) . 'GotoStep/4');
            $this->paymentMethodObj->setReturnLink(Director::absoluteURL($this->controller->Link()));

            $this->paymentMethodObj->processPaymentBeforeOrder();
        }
    }
}