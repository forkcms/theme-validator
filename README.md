# theme-validator
Validates Fork CMS themes and holds the theme's information. Ensures proper installation of all Fork CMS files and provides an easy data structure for use in your project.

##usage

```$theme = new Theme(new ThemeDirectory($pathToTheme));```
  
Doing this will validate the theme and throw exceptions where necessary.  
`$theme` now holds all information about the theme.
