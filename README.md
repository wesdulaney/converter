You can specify a region when creating a new converter. This allows you to generate a string based on units/language of a specific locale. Valid options are 'us' (US), 'eu' (Europe), and 'es' (Spanish) with the default value being 'us'.

When testing the int2str() method, the range of valid numbers is between -999999999999999999 and 999999999999999999.

    $converter = new Converter();
    $string = $converter->int2str(0);
