# Magento2 SalesSequence

Extension change format IncrementID for orders, invoices, credit memos and shipments.

## Compatibility

Magento CE(EE) 2.0.x, 2.1.x, 2.2.x, 2.3.x

## Install

#### Install via Composer (recommend)

1. Go to Magento2 root folder

	i. Enter following commands to install module:

	ii. Create a folder {Magento root}/app/code/Helloworld/SalesSequence

	iii. Download the corresponding [latest version](https://github.com/helloworld348/SalesSequence)

	iv. Copy the unzip content to the folder ({Magento root}/app/code/Helloworld/SalesSequence)

### Completion of installation

1. Go to Magento2 root folder

2. Enter following commands:

    ```bash
    php bin/magento setup:upgrade
    php bin/magento setup:di:compile
    php bin/magento setup:static-content:deploy  (optional)

### Sequence Manager

In the Magento Admin Panel go to *Stores > Sequence Profiles*.
	
<img alt="Magento2 Sales Sequence" src="https://github.com/helloworld348/SalesSequence/blob/main/Screenshot/sales-sequence-profile.PNG" style="width:100%"/>

Custom Order Number

<img alt="Magento2 Custom Order Number" src="https://github.com/helloworld348/SalesSequence/blob/main/Screenshot/sales-sequence-order.PNG" style="width:100%"/>	
