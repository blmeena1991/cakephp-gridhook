<?php

/**
 * Represents an event received by the webhook
 *
 * @see http://sendgrid.com/docs/API_Reference/Webhooks/event.html
 */
class SendgridEvent {

/**
 * The type of event (processed, dropped, delivered, bounce, open, click, unsubscribe, spamreport)
 *
 * @var string
 */
	public $type;

/**
 * The email recipient to which this event is related
 *
 * @var string
 */
	public $email;

/**
 * When the webhook event was received
 *
 * @var DateTime
 */
	public $timestamp;

/**
 * The category that was assigned to the delivered email
 *
 * @var string
 */
	public $category;

/**
 * All params received from the webhook
 *
 * @var array
 */
	public $data = array();

/**
 * Sets the properties in this object as received from the webhook
 *
 * @return void
 */
	public function set($properties) {
		if (isset($properties['event'])) {
			$this->type = $properties['event'];
		}

		if (isset($properties['email'])) {
			$this->email = $properties['email'];
		}

		if (isset($properties['timestamp'])) {
			$this->timestamp = new DateTime('@' . $properties['timestamp']);
		} else {
			$this->timestamp = new DateTime();
		}

		$this->data = $properties;
	}

/**
 * Whether the email was processed by sendgird
 *
 * @return boolean
 */
	public function isProcessed() {
		return $this->type === 'processed';
	}

/**
 * Whether the email was deferred by sendgird
 *
 * @return boolean
 */
	public function isDeferred() {
		return $this->type === 'deferred';
	}

/**
 * Whether the email was dropped by sendgird
 *
 * @return boolean
 */
	public function isDropped() {
		return $this->type === 'dropped';
	}

/**
 * Whether the email was delivered by sendgird
 *
 * @return boolean
 */
	public function isDelivered() {
		return $this->type === 'delivered';
	}

/**
 * Whether the email was opened by the recipient
 *
 * @return boolean
 */
	public function isOpen() {
		return $this->type === 'open';
	}

/**
 * Whether an url in the email was clicked by the recipient
 *
 * @return boolean
 */
	public function isClick() {
		return $this->type === 'click';
	}

/**
 * Whether the email bounced
 *
 * @return boolean
 */
	public function isBounce() {
		return $this->type === 'bounce';
	}

/**
 * Whether the email was marked as spam by the recipient
 *
 * @return boolean
 */
	public function isSpamReport() {
		return $this->type === 'spamreport';
	}

/**
 * Whether the recipient unsubscribed from the newsletter
 *
 * @return boolean
 */
	public function isUnsubscribe() {
		return $this->type === 'unsubscribe';
	}
}
