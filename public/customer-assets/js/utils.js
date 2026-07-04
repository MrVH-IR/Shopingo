class Utils {

    toFarsiNumber(number) {
        const farsiDigits = ['۰','۱','۲','۳','۴','۵','۶','۷','۸','۹'];
        // Add Comma
        number = new Intl.NumberFormat().format(number);
        // Convert To Persian
        return number.toString().replace(/\d/g, x => farsiDigits[x]);
    }
}
