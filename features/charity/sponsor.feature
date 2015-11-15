@frontend @ryl @charity
Feature: Check the sponsors features
  In order to browse sponsors section
  As an anonymous user
  I want to be able to browse for the different sponsors' pages and campaigns

  Background:
    Given I am on "/"

  @200
  Scenario: Check sponsors page exists
    When I go to "charity/sponsor"
    Then the response status code should be 200

  @200 @list
  Scenario: Check list of sponsors
    When I go to "charity/sponsor"
    Then I should see "Sponsors"
    And the response status code should be 200

  @post @add @comment @ok
  Scenario: Add successfully a comment to a post
    When I go to "blog/archive"
    And I follow the first link of section "sonata-blog-post-title"
    And I fill in "comment_name" with "firstname lastname"
    And I fill in "comment_email" with "firstname@lastname.com"
    And I fill in "comment_url" with "http://lastname.com"
    And I fill in "comment_message" with "This is my comment"
    And I press "Add comment"
    Then I should see "This is my comment"