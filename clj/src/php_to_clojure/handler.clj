(ns php-to-clojure.handler
  (:require [compojure.core :refer :all]
            [compojure.route :as route]
            [ring.util.response :as response]
            [ring.middleware.defaults :refer [wrap-defaults site-defaults]]
            [selmer.parser :as selmer]
            ))


(defn render [name]
  (selmer/render-file (format "public/%s.html" name) nil))

(defn index [] (render "index"))

(defn about [] (render "about"))

(defn contact [] (render "contact"))


(defroutes app-routes
  (GET "/" [] (index))
  (GET "/about" [] (about))
  (GET "/contact" [] (contact))
  (route/not-found "Not Found"))

(def app
  (wrap-defaults app-routes site-defaults))
