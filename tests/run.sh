
method="$1"

exitIfInvalidExitCode() {
    if [[ $1 -ne 0 ]]
    then
        exit $1
    fi
}

runMigrations() {
    echo "Running migrations..."
    bin/console doctrine:migrations:migrate --no-interaction
    exitIfInvalidExitCode $?

    echo "Migrations run"
}

dependenciesUp() {
    echo "Dependencies up"
}

dependenciesDown() {
    echo "Dependencies down"
}

functional() {
    dependenciesUp
    runMigrations
    php vendor/bin/behat --suite=functional --format=progress $*
    exitIfInvalidExitCode $?
    dependenciesDown
}

unit() {
    dependenciesUp
    php vendor/bin/phpunit --testsuite=unit --no-coverage $*
    exitIfInvalidExitCode $?
    dependenciesDown
}


testAll() {
    unit
    functional
}

case "$method" in
  all)
    testAll
    ;;
  functional)
    functional $*
    ;;
  unit)
    unit $*
    ;;
  *)
    testAll
esac

exit 0
