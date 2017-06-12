(ns php-to-clojure.core
  (:gen-class)
  (:require [ring.adapter.jetty :as jetty]
            [php-to-clojure.handler :as handler]))

(defn -main [& args]
  (jetty/run-jetty handler/app {:port 5005}))
