# Location Search

This extension adds location based search functionality to CiviCRM

## Getting Started

### Prerequisites

```
Drupal 7
CiviCRM 4.7
```

### Installing

Locate you extensions directory and clone the extension

```
cd /civicrm/extensions/directory
git clone https://github.com/lemacarl/com.lema.locationsearch.git
```

For more information on how to install CiviCRM extensions (https://docs.civicrm.org/sysadmin/en/latest/customize/extensions)

### Usage

Navigate to www.yoursitehere.com/civicrm/admin/setting/mapping?reset=1 and enable a Mapping and Geocoding provider. Depending on your provider you may need an API key for this to work effectively.

To use the search builder go to www.yoursitehere.com/civicrm/contact/search/builder?reset=1 

Select `Contacts` then `Proximity Distance Unit` and select either `miles` or `kilometres`. Note that `kilometres` is the default setting.

Then add `Another search field` and select `Contacts` then `Proximity Distance`. Select an operator and then enter the range.

Finally add `Another search field` and select `Contacts` then `Postal Code`. Enter the postal code from which to base the proximity search. Note that proximity search can not work effectively unless a postal code has been set. Then click `Search`.