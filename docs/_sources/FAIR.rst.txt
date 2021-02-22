CAGS & FAIR principles
======================

FAIR: Findability, Accessibility, Interoperability, and Reuse


Findability
-----------
To enable an effective findability of users contributions, the website interface automatically extracts and inserts into the database all the metadata provided in the user submission form (for each type i.e. datasets, numerical studies and communications). The website interface allows then the retrieval and display of the contribution thanks to its search and filtering tool. A geospatial visualization and analysis component enables searching, visualizing, and analyzing users’ contributions.

.. _importing:
.. figure:: ./images/Map_contributions_26102020.png
    :scale: 50 %
    :alt: Geospatial visualization (26/10/2020)

    Map of georeferenced studies (zoom on the Mediterranean basin). The map is based on the Leaflet framework and use map background from the OpenStreetMap project.


Accessibility
-------------
Once the user finds the required data, it can be access thanks to its DOI link. Metadata are accessible, even when the data are no longer available.


Interoperability
----------------
The concept of standardized descriptive metadata provides a powerful mechanism to improve retrieval for specific applications and user communities and facilitates repository interoperability. The catalogue metadata architecture we implemented for CGAS has been inspired by the Archaeology Data Service (ADS, Richards, 2018) which acts as a metadata aggregator between archaeological and geophysical metadata.


Reuse
-----
As a start, CAGS implement useful tools for the dataset:

 To make this decision, the data publisher should provide not just metadata that allows discovery, but also metadata that richly describes the context under which the data was generated.

-	A data package linter , which could check for structure and files 
-	At the raw data level, REDA may also serve as a translation service, converting old formats to new ones when necessary, especially for IP/SIP data, a fact that will highly contribute to the long-term data management and reuse. 
-	At the (pre)-processed data level, the user may want to share the journal file produced using the REDA Python package.

