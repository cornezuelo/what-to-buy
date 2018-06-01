# what-to-buy
A PHP manager for shopping lists stored in JSON

# TODO
- Parsing URIs for offering a better user experience, adding images, descriptions or embedded players:
  - Bandcamp
  - Soundcloud
  - Amazon
  - Ebay
- Protecting the control panel with a password.
- Refactorizing the controller, using two classes:
  - Parser.php: For the parsing jobs. It will have got more classes that extend from it, as AmazonParser
  - JSONDb.php: Abstract library for managing json databases in PHP. Do it thinking about reusability in future projects.