<?php

namespace App\Utils;

class NameGenerator
{
    /**
     * Generate a friendly name from an email address.
     * Removes digits from the local part, splits on common delimiters
     * and returns "First Last" when possible, otherwise a single capitalized token.
     */
    public static function fromEmail(string $email): string
    {
        // get local part
        $local = strstr($email, '@', true) ?: $email;

        // remove digits
        $clean = preg_replace('/\d+/', '', $local);

        // replace common separators with space
        $clean = preg_replace('/[._\-\+]+/', ' ', $clean);

        // normalize whitespace and split
        $parts = array_values(array_filter(array_map('trim', preg_split('/\s+/', $clean))));

        if (count($parts) >= 2) {
            return ucfirst(strtolower($parts[0])) . ' ' . ucfirst(strtolower($parts[1]));
        }

        if (count($parts) === 1) {
            $token = $parts[0];

            // attempt to split camelCase or PascalCase into two words
            $split = preg_split('/(?<=[a-z])(?=[A-Z])|(?=[A-Z][a-z])/', $token);
            if (count($split) >= 2) {
                return ucfirst(strtolower($split[0])) . ' ' . ucfirst(strtolower($split[1]));
            }

            return ucfirst(strtolower($token));
        }

        return 'User';
    }
}