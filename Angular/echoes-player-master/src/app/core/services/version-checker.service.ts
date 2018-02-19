import { Subscription } from 'rxjs/Subscription';
import { HttpClient } from '@angular/common/http';
import { Injectable, NgZone } from '@angular/core';
import { Observable } from 'rxjs/Observable';

import { AppApi } from '@api/app.api';

import 'rxjs/add/operator/retry';
import 'rxjs/add/observable/timer';
import 'rxjs/add/observable/of';

interface INpmPackageJson {
  version: number;
  [param: string]: any;
}

function verifyPackage(packageJson: INpmPackageJson) {
  return packageJson.hasOwnProperty('version');
}

@Injectable()
export class VersionCheckerService {
  private interval = 1000 * 60 * 60;
  private protocol = 'https';
  private prefix = 'raw.githubusercontent.com';
  private repo = 'orizens/echoes-player';
  private repoBranch = 'gh-pages';
  private pathToFile = 'assets/package.json';
  public url = `${this.protocol}://${this.prefix}/${this.repo}/${this.repoBranch}/${this.pathToFile}`;

  constructor(private http: HttpClient,
    private zone: NgZone, private appApi: AppApi) { }

  check() {
    return this.http.get(this.url);
  }

  start() {
    let checkTimer: Subscription;
    this.zone.runOutsideAngular(() => {
      checkTimer = Observable.timer(0, this.interval)
        .switchMap(() => this.check())
        // .catch((err) => {
        //   console.log(err);
        //   return Observable.of(err);
        // })
        .retry()
        .filter(verifyPackage)
        .subscribe(response => this.appApi.recievedNewVersion(response));
    });
    return checkTimer;
  }

  updateVersion() {
    if (window) {
      window.location.reload(true);
    }
  }

  checkForVersion() {
    return this.check()
      .retry()
      .filter(verifyPackage)
      .take(1)
      .subscribe(response => this.appApi.notifyNewVersion(response));
  }
}
