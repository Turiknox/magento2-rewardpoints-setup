# Turiknox Reward Points Setup

## Overview

In development. A Magento 2 module that sets up the base tables and UI grid components needed for a basic reward points module.

## Requirements

Magento 2.1.x

## Installation

Copy the contents of the module into your Magento root directory.

Enable the module via the command line:

/path/to/php bin/magento module:enable Turiknox_RewardPoints

Run the database upgrade via the command line:

/path/to/php bin/magento setup:upgrade

Run the compile command and refresh the Magento cache:

/path/to/php bin/magento setup:di:compile 

/path/to/php bin/magento cache:clean


## Usage

View the grid components under Marketing -> Reward Points
